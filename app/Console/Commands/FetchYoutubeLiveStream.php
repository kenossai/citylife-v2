<?php

namespace App\Console\Commands;

use App\Models\Sermon;
use Google\Client as GoogleClient;
use Google\Service\YouTube;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchYoutubeLiveStream extends Command
{
    protected $signature = 'sermons:fetch-live-stream
                            {--force : Run even if it is not Sunday}';

    protected $description = 'Auto-fetch the current YouTube live stream URL and activate it on matching sermons (runs Sundays 11:15 AM).';

    public function handle(): int
    {
        $apiKey    = config('services.youtube.api_key');
        $channelId = config('services.youtube.channel_id');

        if (! $apiKey || ! $channelId) {
            $this->error('YOUTUBE_API_KEY or YOUTUBE_CHANNEL_ID is not set in .env');
            return self::FAILURE;
        }

        // Query YouTube Data API for the active live broadcast on this channel
        $client = new GoogleClient();
        $client->setDeveloperKey($apiKey);
        $youtube = new YouTube($client);

        try {
            $response = $youtube->search->listSearch('id,snippet', [
                'channelId'  => $channelId,
                'eventType'  => 'live',
                'type'       => 'video',
                'maxResults' => 1,
            ]);
        } catch (\Throwable $e) {
            $this->error('YouTube API error: ' . $e->getMessage());
            Log::error('FetchYoutubeLiveStream: ' . $e->getMessage());
            return self::FAILURE;
        }

        $items = $response->getItems();

        if (empty($items)) {
            $this->info('No active live stream found on this channel right now.');

            // Turn off any sermons that were live-fetched previously
            Sermon::where('auto_fetch_live', true)
                ->where('is_live', true)
                ->update(['is_live' => false, 'video_url' => null]);

            return self::SUCCESS;
        }

        $videoId  = $items[0]->getId()->getVideoId();
        $videoUrl = 'https://www.youtube.com/watch?v=' . $videoId;

        $this->info("Live stream found: {$videoUrl}");

        // Find all sermons with auto_fetch_live = true (active, today or upcoming)
        $sermons = Sermon::where('auto_fetch_live', true)->where('is_active', true)->get();

        if ($sermons->isEmpty()) {
            $this->warn('No sermons have auto_fetch_live enabled.');
            return self::SUCCESS;
        }

        foreach ($sermons as $sermon) {
            $sermon->update([
                'video_url' => $videoUrl,
                'is_live'   => true,
            ]);
            $this->line("  Updated sermon #{$sermon->id}: {$sermon->title}");
        }

        $this->info('Done.');
        return self::SUCCESS;
    }
}
