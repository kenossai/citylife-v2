<x-filament-panels::page>
    @php
        /** @var \App\Models\ActivityLog $record */
        $record = $this->getRecord();
        $properties = $record->properties->toArray();
        $attributes = $properties['attributes'] ?? [];
        $old        = $properties['old'] ?? [];
        $isUpdate   = $record->event === 'updated' && ! empty($old);

        $actionColor = match($record->event) {
            'created'    => 'text-green-600 bg-green-50 ring-green-200 dark:text-green-400 dark:bg-green-950 dark:ring-green-800',
            'updated'    => 'text-amber-600 bg-amber-50 ring-amber-200 dark:text-amber-400 dark:bg-amber-950 dark:ring-amber-800',
            'deleted'    => 'text-red-600 bg-red-50 ring-red-200 dark:text-red-400 dark:bg-red-950 dark:ring-red-800',
            'logged_in'  => 'text-green-600 bg-green-50 ring-green-200 dark:text-green-400 dark:bg-green-950 dark:ring-green-800',
            'logged_out' => 'text-gray-600 bg-gray-50 ring-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:ring-gray-700',
            default      => 'text-gray-600 bg-gray-50 ring-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:ring-gray-700',
        };
        $severityColor = match($record->severity) {
            'high'   => 'text-red-600 bg-red-50 ring-red-200 dark:text-red-400 dark:bg-red-950 dark:ring-red-800',
            'medium' => 'text-amber-600 bg-amber-50 ring-amber-200 dark:text-amber-400 dark:bg-amber-950 dark:ring-amber-800',
            default  => 'text-green-600 bg-green-50 ring-green-200 dark:text-green-400 dark:bg-green-950 dark:ring-green-800',
        };
        $categoryColor = match($record->category) {
            'Personal Information' => 'text-amber-600 bg-amber-50 ring-amber-200 dark:text-amber-400 dark:bg-amber-950 dark:ring-amber-800',
            'Authentication'       => 'text-blue-600 bg-blue-50 ring-blue-200 dark:text-blue-400 dark:bg-blue-950 dark:ring-blue-800',
            'Courses'              => 'text-green-600 bg-green-50 ring-green-200 dark:text-green-400 dark:bg-green-950 dark:ring-green-800',
            default                => 'text-gray-600 bg-gray-50 ring-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:ring-gray-700',
        };
    @endphp

    <div class="space-y-6">

        {{-- Meta card --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content px-6 py-5">
                <dl class="grid grid-cols-2 gap-x-8 gap-y-5 sm:grid-cols-4">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Action</dt>
                        <dd>
                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $actionColor }}">
                                {{ $record->action_label }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Category</dt>
                        <dd>
                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $categoryColor }}">
                                {{ $record->category ?? '—' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Severity</dt>
                        <dd>
                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $severityColor }}">
                                {{ ucfirst($record->severity ?? 'low') }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Sensitive</dt>
                        <dd class="flex items-center gap-1.5 mt-0.5">
                            @if($record->is_sensitive)
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <span class="text-sm text-amber-600 dark:text-amber-400 font-medium">Yes</span>
                            @else
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-sm text-gray-500">No</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Performed By</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $record->causer_label }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Resource</dt>
                        <dd class="text-sm text-gray-700 dark:text-gray-300">{{ $record->resource_type }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Item</dt>
                        <dd class="text-sm text-gray-700 dark:text-gray-300">{{ $record->subject_label }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Timestamp</dt>
                        <dd class="text-sm text-gray-700 dark:text-gray-300">{{ $record->created_at->format('j F Y, g:i:s A') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Changes --}}
        @if(! empty($attributes) || ! empty($old))
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-header flex items-center gap-3 px-6 py-4 border-b border-gray-100 dark:border-white/10">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ $isUpdate ? 'Changes' : ($record->event === 'created' ? 'Created With' : 'Snapshot at Deletion') }}
                </h3>
                @if($isUpdate)
                <span class="text-xs text-gray-400">{{ count($old) }} field(s) changed</span>
                @endif
            </div>

            <div class="overflow-x-auto">
                @if($isUpdate)
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-white/10">
                            <th class="py-2.5 px-6 text-left text-xs font-semibold uppercase tracking-wider text-gray-400 w-1/4">Field</th>
                            <th class="py-2.5 px-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400 w-[37.5%]">Before</th>
                            <th class="py-2.5 px-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400 w-[37.5%]">After</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @foreach($old as $field => $before)
                        @php $after = $attributes[$field] ?? null; @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 dark:text-gray-300">
                                {{ ucwords(str_replace('_', ' ', $field)) }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-block max-w-xs truncate rounded px-2 py-0.5 text-xs bg-red-50 text-red-700 ring-1 ring-red-200 dark:bg-red-950 dark:text-red-300 dark:ring-red-800">
                                    {{ is_array($before) ? json_encode($before) : ($before ?? '—') }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-block max-w-xs truncate rounded px-2 py-0.5 text-xs bg-green-50 text-green-700 ring-1 ring-green-200 dark:bg-green-950 dark:text-green-300 dark:ring-green-800">
                                    {{ is_array($after) ? json_encode($after) : ($after ?? '—') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-white/10">
                            <th class="py-2.5 px-6 text-left text-xs font-semibold uppercase tracking-wider text-gray-400 w-1/3">Field</th>
                            <th class="py-2.5 px-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-400">Value</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @foreach($attributes as $field => $value)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="py-3 px-6 font-medium text-gray-700 dark:text-gray-300">
                                {{ ucwords(str_replace('_', ' ', $field)) }}
                            </td>
                            <td class="py-3 px-4 text-gray-600 dark:text-gray-400 max-w-sm truncate">
                                {{ is_array($value) ? json_encode($value) : ($value ?? '—') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        @else
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 px-6 py-8 text-center text-sm text-gray-400">
            No field-level details were captured for this event.
        </div>
        @endif

    </div>
</x-filament-panels::page>
