<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles/permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ── Resource list ──────────────────────────────────────────────────
        $contentResources = [
            'Book', 'CoreValue', 'Department', 'DepartmentMember',
            'Event', 'HeroSlide', 'Leader', 'Ministry',
            'Sermon', 'SermonSeries', 'WorshipCentre',
        ];

        $memberResources = [
            'Member', 'Course', 'CourseEnrollment', 'CourseLesson',
            'LessonAttendance',
        ];

        $allResources = array_merge($contentResources, $memberResources, ['Role', 'User']);

        $crudActions       = ['ViewAny', 'View', 'Create', 'Update', 'Delete', 'DeleteAny'];
        $extendedActions   = array_merge($crudActions, ['ForceDelete', 'ForceDeleteAny', 'Replicate', 'Reorder', 'Restore', 'RestoreAny']);

        $pages    = ['EditAboutSection', 'EditCtaSection', 'EditMissionsSection'];
        $widgets  = ['StatsOverviewWidget', 'CourseLearningProgressWidget'];

        // ── Super Admin ────────────────────────────────────────────────────
        // Gets all permissions implicitly via Gate::before in shield config.
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // ── Admin ──────────────────────────────────────────────────────────
        // Full CRUD on everything except Role management
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $adminPermissions = [];
        foreach (array_merge($contentResources, $memberResources) as $resource) {
            foreach ($extendedActions as $action) {
                $adminPermissions[] = "{$action}:{$resource}";
            }
        }
        foreach ($pages as $page)     { $adminPermissions[] = "View:{$page}"; }
        foreach ($widgets as $widget) { $adminPermissions[] = "View:{$widget}"; }

        $admin->syncPermissions(
            Permission::whereIn('name', $adminPermissions)->get()
        );

        // ── Content Manager ────────────────────────────────────────────────
        // Full CRUD on content only; view-only on members/courses; no role mgmt
        $contentManager = Role::firstOrCreate(['name' => 'content_manager', 'guard_name' => 'web']);

        $cmPermissions = [];
        foreach ($contentResources as $resource) {
            foreach ($extendedActions as $action) {
                $cmPermissions[] = "{$action}:{$resource}";
            }
        }
        // View-only for member/course resources
        foreach ($memberResources as $resource) {
            $cmPermissions[] = "ViewAny:{$resource}";
            $cmPermissions[] = "View:{$resource}";
        }
        foreach ($pages as $page)     { $cmPermissions[] = "View:{$page}"; }
        foreach ($widgets as $widget) { $cmPermissions[] = "View:{$widget}"; }

        $contentManager->syncPermissions(
            Permission::whereIn('name', $cmPermissions)->get()
        );

        // ── Viewer ─────────────────────────────────────────────────────────
        // Read-only access to everything
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        $viewPermissions = [];
        foreach ($allResources as $resource) {
            $viewPermissions[] = "ViewAny:{$resource}";
            $viewPermissions[] = "View:{$resource}";
        }
        foreach ($pages as $page)     { $viewPermissions[] = "View:{$page}"; }
        foreach ($widgets as $widget) { $viewPermissions[] = "View:{$widget}"; }

        $viewer->syncPermissions(
            Permission::whereIn('name', $viewPermissions)->get()
        );

        $this->command->info('Roles created: super_admin, admin, content_manager, viewer');
    }
}
