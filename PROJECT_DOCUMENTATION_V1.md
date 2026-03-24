# CityLife Church — Full Project Documentation (Version 1)
> **Purpose:** Complete reference document for rebuilding or extending the platform as Version 2.
> **Generated:** March 2026

---

## Table of Contents
1. [Project Overview](#1-project-overview)
2. [Technology Stack](#2-technology-stack)
3. [Architecture Overview](#3-architecture-overview)
4. [Authentication & Authorization](#4-authentication--authorization)
5. [Database Schema & Models](#5-database-schema--models)
6. [Public-Facing Website (Frontend)](#6-public-facing-website-frontend)
7. [Admin Panel (Filament)](#7-admin-panel-filament)
8. [Core Feature Workflows](#8-core-feature-workflows)
9. [Third-Party Integrations](#9-third-party-integrations)
10. [Background Services & Automation](#10-background-services--automation)
11. [Security & Compliance](#11-security--compliance)
12. [Deployment & Infrastructure](#12-deployment--infrastructure)
13. [Known Limitations & V2 Improvement Areas](#13-known-limitations--v2-improvement-areas)

---

## 1. Project Overview

**CityLife Church** is a full-stack church management and public-presence web application built on Laravel 12. It serves two primary audiences:

- **Public visitors** — browse the church website, view events, sermons, courses, ministries, news, missions, and contact the church.
- **Authenticated members & staff** — manage their profile, enroll in Bible school courses, access learning materials, and (for staff/admins) manage all church data via a Filament admin panel.

The project was started in August 2025 and has since grown to cover membership management, course delivery, departmental rota scheduling, GDPR compliance, ChurchSuite CRM integration, social media auto-posting, and more.

---

## 2. Technology Stack

| Layer | Technology |
|---|---|
| **Language** | PHP 8.2+ |
| **Framework** | Laravel 12 |
| **Admin Panel** | Filament 3.3 |
| **Frontend Build** | Vite 6 + Tailwind CSS 4 |
| **Reactive UI** | Livewire (used for lock screen, registration modals) |
| **Database** | MySQL (production) / SQLite (local dev) |
| **Queue / Cache** | Redis (production via Laravel Cloud) |
| **File Storage** | AWS S3 (production), local disk (dev) |
| **Email** | SMTP (Gmail / Postmark / Resend configurable) |
| **SMS** | Vonage or Twilio (configurable via `SMS_DRIVER`) |
| **Authentication** | Laravel Session Guards (`web` for staff, `member` for members) |
| **Deployment** | Laravel Cloud (primary), Heroku-compatible (secondary) |
| **CI/CD** | GitHub (connected to Laravel Cloud) |
| **Excel Export** | Maatwebsite/Excel 3.1 |
| **Google APIs** | YouTube Data API v3 (live stream detection) |

---

## 3. Architecture Overview

```
┌──────────────────────────────────────────────────────────────────┐
│                         Public Website                           │
│  (Blade templates + Vite/Tailwind, minimal JS, no SPA)          │
│  Routes: web.php → Controllers → Views                          │
└─────────────────────────────┬────────────────────────────────────┘
                              │
┌─────────────────────────────▼────────────────────────────────────┐
│                     Laravel Application                          │
│                                                                  │
│  ┌─────────────┐  ┌──────────────┐  ┌────────────────────────┐ │
│  │  Controllers│  │   Services   │  │  Filament Admin Panel  │ │
│  │  (HTTP)     │  │  (Business   │  │  /admin route prefix   │ │
│  │             │  │   Logic)     │  │  RBAC via Roles/Perms  │ │
│  └─────────────┘  └──────────────┘  └────────────────────────┘ │
│                                                                  │
│  ┌─────────────────────────────────────────────────────────┐   │
│  │          Eloquent Models / Database (MySQL)              │   │
│  └─────────────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────────────┘
                              │
        ┌─────────────────────┼──────────────────────┐
        ▼                     ▼                      ▼
   ChurchSuite CRM      YouTube API v3        Social Media APIs
   (OAuth2 sync)        (Live streams)        (FB/Twitter/IG/LI)
```

### Directory Structure Summary

```
app/
  Console/          — Artisan commands (scheduled jobs)
  Exports/          — Excel export classes (Maatwebsite)
  Filament/
    Pages/          — Custom Filament pages (Dashboard, LockScreen, ChangePassword)
    Resources/      — ~60 Filament CRUD resources
    Widgets/        — Dashboard analytics widgets
  Http/
    Controllers/    — ~25 public-facing page controllers
      Auth/         — MemberAuthController
    Middleware/     — Session, auth, permission, SEO, spam middleware
  Livewire/
    Filament/       — NotificationIcon (Livewire component in admin)
    LockScreenPage.php
    RegistrationInterestModal.php
  Models/           — ~60+ Eloquent models
  Notifications/    — Laravel notification classes (email/SMS)
  Observers/        — EventObserver, NewsObserver (auto social posting)
  Policies/         — Authorization policies
  Providers/        — AppServiceProvider (observer registration, events)
  Services/         — Business logic services
  Traits/           — HasSEO, Auditable, etc.
  View/             — View composers / components

resources/
  css/              — Tailwind entry point
  js/               — app.js (Vite entry)
  views/
    index.blade.php          — Homepage
    layouts/                 — app.blade.php, admin layouts
    pages/                   — Public pages (about, events, courses, etc.)
    auth/                    — Member login/register views
    member/                  — Member dashboard views
    emails/                  — Email notification views
    components/              — Reusable Blade components
    filament/                — Filament overrides

routes/
  web.php           — All application routes
  console.php       — Scheduled commands
  debug.php         — Debug-only routes
```

---

## 4. Authentication & Authorization

### Two Authentication Guards

The application uses two completely separate authentication guards:

#### Guard 1: `web` (Staff / Admin)
- **Model:** `App\Models\User`
- **Access:** Filament admin panel at `/admin`
- **Session:** Standard Laravel session
- **Features:** RBAC (Roles & Permissions), forced password change, session timeout, lock screen

#### Guard 2: `member`
- **Model:** `App\Models\Member`
- **Access:** Member portal — course registration, lesson access, profile management
- **Login URL:** `/member/login`
- **Session:** Separate session key (`login_member_*`)
- **Features:** Email verification, token-based registration (invitation flow), GDPR consent

### Member Authentication Workflow

```
1. Admin invites member (or member registers interest)
2. System sends invitation email with unique token
3. Member visits /register/{token}
4. Member completes registration form (sets password)
5. Email verification link sent → /verify-email/{token}
6. Upon verification: account marked as email_verified_at
7. Admin approves member (approved_at, approved_by set)
8. Member can now log in at /member/login
9. Successful login → session created → redirected to /my-courses
```

### Staff Authentication Workflow

```
1. Admin creates User in Filament (Users resource)
2. User receives credentials
3. Login at /admin/login (Filament built-in)
4. If force_password_change = true → redirected to /admin/change-password
5. Session idle timeout → lock screen at /admin/lock-screen
6. User enters password to unlock (Livewire LockScreenPage component)
```

### Role-Based Access Control (RBAC)

- **Tables:** `roles`, `permissions`, `role_permission`, `user_roles`
- **Roles** are assigned to `User` (staff) models
- **Permissions** are granular actions (e.g., `manage-members`, `view-reports`)
- **Middleware:** `CheckPermission` applied on sensitive Filament pages/actions
- **Filament integration:** Each resource's `canViewAny`, `canCreate`, `canEdit`, `canDelete` are overridden to check roles

### Middleware Stack

| Middleware | Purpose |
|---|---|
| `MemberAuthenticated` | Protect member-only routes (redirects to `/member/login`) |
| `CheckPermission` | Verify staff user has specific permission |
| `CheckSessionTimeout` | Auto-lock admin panel on inactivity |
| `EnsureConsistentSession` / `ForceSessionConsistency` | Prevent session fixation/hijacking |
| `ForcePasswordChange` | Redirect admin users who must change password |
| `SEOMiddleware` | Inject dynamic SEO meta tags |
| `Authenticate` | Standard Laravel auth middleware |

---

## 5. Database Schema & Models

### Member-Related Models

| Model | Table | Key Fields |
|---|---|---|
| `Member` | `members` | membership_number, title, first/last/middle name, DOB, gender, marital_status, email, phone, address, membership_status, baptism_status, gdpr_consent, churchsuite_id, approved_at |
| `User` | `users` | name, email, password, job_title, department, is_active, force_password_change, roles (via pivot) |
| `Role` | `roles` | name, slug, description |
| `Permission` | `permissions` | name, slug, category |
| `UserRole` | `user_roles` | user_id, role_id |
| `GdprConsent` | `gdpr_consents` | member_id, consent_type, given_at, ip_address |
| `GdprAuditLog` | `gdpr_audit_logs` | member_id, action, description, old/new values |
| `GdprDataRequest` | `gdpr_data_requests` | member_id, request_type (export/delete), status |

### Content Models

| Model | Table | Key Fields |
|---|---|---|
| `Event` | `events` | title, slug, start/end_date, location, requires_registration, max_attendees, is_published, event_anchor (ministry/team), speakers (via EventSpeaker) |
| `News` | `news` | title, slug, content, category, is_published, published_at, featured_image |
| `Ministry` | `ministries` | name, slug, description, leader, contact_email, is_active |
| `Mission` | `missions` | title, type (home/abroad), location, description, is_active |
| `TeamMember` | `team_members` | name, slug, role, bio, photo, department (pastoral/leadership) |
| `TeachingSeries` | `teaching_series` | title, slug, category, pastor (→ TeamMember), youtube_url, youtube_live_url, sermon_notes, views_count |
| `Book` | `books` | title, author, slug, description, featured_image, is_published |
| `Banner` | `banners` | title, subtitle, image, link, is_active, sort_order |
| `Gallery` | `galleries` | title, images (JSON), is_active |
| `CoreValue` | `core_values` | title, slug, content, icon, sort_order |
| `AboutPage` | `about_page` | title, vision, mission, content, is_active |

### Course / Bible School Models

| Model | Table | Key Fields |
|---|---|---|
| `Course` | `courses` | title, slug, category, instructor, start/end_date, has_certificate, is_registration_open |
| `CourseLesson` | `course_lessons` | course_id, title, content, video_url, lesson_number, has_quiz |
| `CourseEnrollment` | `course_enrollments` | course_id, user_id (member), status, attendance_count, certificate_issued |
| `LessonProgress` | `lesson_progress` | enrollment_id, lesson_id, completed_at, quiz_score |
| `LessonAttendance` | `lesson_attendances` | enrollment_id, lesson_id, attended_at |
| `BibleSchoolEvent` | `bible_school_events` | title, date, location, description, is_published |
| `BibleSchoolVideo` | `bible_school_videos` | title, youtube_url, speaker_id, is_published |
| `BibleSchoolAudio` | `bible_school_audios` | title, audio_file, speaker_id, is_published |
| `BibleSchoolSpeaker` | `bible_school_speakers` | name, bio, photo |
| `BibleSchoolAccessCode` | `bible_school_access_codes` | code, member_id, expires_at, used_at |
| `BibleSchoolOtpToken` | `bible_school_otp_tokens` | token, member_id, expires_at |

### Department / Rota Models

| Model | Table | Key Fields |
|---|---|---|
| `WorshipDepartment` | `worship_departments` | name, description |
| `WorshipDepartmentMember` | `worship_department_members` | department_id, member_id, role, sort_order |
| `TechnicalDepartment` | `technical_departments` | name |
| `TechnicalDepartmentMember` | `technical_department_members` | department_id, member_id, role, sort_order |
| `PreacherDepartment` | `preacher_departments` | name |
| `PreacherDepartmentMember` | `preacher_department_members` | department_id, team_member_id, member_id, role |
| `DepRole` | `dep_roles` | name, department_type (worship/technical/preacher) |
| `Rota` | `rotas` | name, department_type, departments (JSON array), start_date, end_date, schedule (JSON) |

### Communication & Admin Models

| Model | Table | Key Fields |
|---|---|---|
| `Contact` | `contacts` | church address, phone, email, map_embed_url |
| `ContactSubmission` | `contact_submissions` | name, email, subject, message, is_read, is_spam |
| `NewsletterSubscriber` | `newsletter_subscribers` | email, name, is_active, gdpr_consent |
| `VolunteerApplication` | `volunteer_applications` | name, email, ministry, skills, status |
| `BabyDedication` | `baby_dedications` | parent names, baby details, preferred date, status |
| `GiftAidDeclaration` | `gift_aid_declarations` | member_id, address, declaration_date, is_active |
| `Giving` | `givings` | amount, type, notes, date, donor info |
| `PastoralReminder` | `pastoral_reminders` | member_id, type, due_date, notes, is_completed |
| `PastoralNotification` | `pastoral_notifications` | member_id, type, sent_at, channel |
| `AuditTrail` | `audit_trails` | user_id, action, model_type, model_id, old/new values |
| `BlockedIp` | `blocked_ips` | ip_address, reason, blocked_at |
| `BackupLog` | `backup_logs` | filename, size, status, created_at |
| `SocialMediaPost` | `social_media_posts` | content_type, content_id, platform, status, platform_post_id |
| `SEOSettings` | `seo_settings` | page, meta_title, meta_description, og_image |
| `YouthCamping` | `youth_campings` | title, dates, location, price, is_active |
| `YouthCampingRegistration` | `youth_camping_registrations` | camping_id, member_id, guardian info, status |
| `RegistrationInterest` | `registration_interests` | email, name, course/event slug |

### Model Traits

- **`HasSEO`** — adds `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `og_image` fields to models (Event, News, etc.)
- **`Auditable`** — hooks into model events to write to `audit_trails` table (used on `User`)

---

## 6. Public-Facing Website (Frontend)

### Pages & Routes

| Route | Controller | View |
|---|---|---|
| `/` | `HomeController@index` | `index.blade.php` |
| `/about-citylife` | `AboutController@index` | `pages/about/index` |
| `/about/core-values/{slug}` | `AboutController@showCoreValue` | `pages/about/core-value` |
| `/our-ministry` | `AboutController@ourMinistry` | `pages/about/our-ministry` |
| `/events` | `EventController@index` | `pages/event/index` |
| `/events/{slug}` | `EventController@show` | `pages/event/show` |
| `/news` | `NewsController@index` | `pages/news` |
| `/news/{slug}` | `NewsController@show` | — |
| `/ministries` | `MinistryController@index` | `pages/ministries` |
| `/ministries/{slug}` | `MinistryController@show` | — |
| `/ministries/{slug}/contact` | `MinistryController@contact` | — |
| `/missions` | `MissionController@index` | `pages/mission` |
| `/missions/home` | `MissionController@home` | — |
| `/missions/abroad` | `MissionController@abroad` | — |
| `/team` | `TeamController@index` | `pages/team` |
| `/team/pastoral` | `TeamController@pastoral` | — |
| `/team/leadership` | `TeamController@leadership` | — |
| `/team/{slug}` | `TeamController@show` | — |
| `/courses` | `CourseController@index` | `pages/course/index` |
| `/courses/{slug}` | `CourseController@show` | `pages/course/show` |
| `/books` | `BookController@index` | `pages/books` |
| `/books/{slug}` | `BookController@show` | — |
| `/giving` | `GivingController@index` | `pages/giving` |
| `/giving/gift-aid` | `GivingController@submitGiftAid` | — |
| `/contact` | `ContactController@index` / `submit` | `pages/contact` |
| `/privacy-policy` | (view route) | `pages/privacy-policy` |
| `/cookie-policy` | `CookieConsentController@cookiePolicy` | — |
| `/bible-school` | served under `pages/bible-school/` | — |

### Protected Member Routes (middleware: `member.auth`)

| Route | Description |
|---|---|
| `/courses/{slug}/register` | Show & submit course registration form |
| `/my-courses` | Member dashboard with enrolled courses |
| `/courses/{slug}/lessons` | List lessons for a course |
| `/courses/{courseSlug}/lessons/{lessonSlug}` | View individual lesson |
| `/courses/{courseSlug}/lessons/{lessonSlug}/quiz` | Take lesson quiz |
| `/courses/{courseSlug}/lessons/{lessonSlug}/complete` | Mark lesson complete |
| `/my-profile` | View/edit member profile |
| `/my-profile` (PUT) | Update profile details |
| `/my-profile/password` (PUT) | Change password |
| `/my-profile/preferences` (PUT) | Update notification preferences |

### Frontend Technologies

- **CSS Framework:** Tailwind CSS v4 (configured via `@tailwindcss/vite` plugin)
- **JS:** Minimal vanilla JS via `resources/js/app.js`; Axios bundled
- **Build Tool:** Vite 6 with `laravel-vite-plugin`
- **Layout System:** Blade layouts with `@extends` / `@section`
  - `layouts/app.blade.php` — public site layout
  - Filament uses its own Filament layout system
- **SEO:** Dynamic meta tags injected via `SEOMiddleware` + `SEOService`; per-model `HasSEO` trait
- **Cookie Consent:** Custom GDPR cookie banner with granular Accept/Reject controls; consent stored in session and database

---

## 7. Admin Panel (Filament)

The admin panel runs at `/admin` using Filament 3.3. Only `User` model instances with `canAccessPanel()` returning true can access it.

### Dashboard

The Filament dashboard aggregates the following widgets:

| Widget | Content |
|---|---|
| `OverviewStatsWidget` | Total members, events, courses, news items |
| `MemberAnalyticsWidget` | New members over time, membership status breakdown |
| `CourseStatsWidget` / `CourseAnalyticsWidget` | Enrollments, completions, active courses |
| `EventAnalyticsWidget` | Upcoming events, attendance stats |
| `CommunicationStatsWidget` | Newsletter subscribers, contact submissions |
| `GiftAidStatsWidget` | Gift aid declarations, giving totals |
| `NewsletterStatsWidget` | Subscriber growth |
| `RecentActivityWidget` | Latest audit trail entries |
| `UpcomingBirthdaysWidget` | Members with upcoming birthdays (pastoral care) |
| `UpcomingPastoralRemindersWidget` | Overdue/upcoming pastoral reminders |
| `ProgressTrackingWidget` | Course progress tracking summary |

### Admin Resources (Filament CRUD)

All resources reside in `app/Filament/Resources/`. Each has embedded `ListRecords`, `CreateRecord`, `EditRecord`, and often `ViewRecord` pages.

**Members & Users**
- `MemberResource` — Full member management with ChurchSuite sync action, approval workflow
- `VerifiedMembersResource` — Filtered view of verified/approved members
- `StaffUserResource` — Manage admin users
- `RoleResource` / `PermissionResource` — RBAC management

**Content Management**
- `EventResource` — Create/edit events with speaker associations, registration settings
- `NewsResource` — Church announcements / news articles
- `MinistryResource` — Ministry pages
- `MissionResource` — Mission projects (home and abroad)
- `TeamMemberResource` — Pastoral and leadership team profiles
- `TeachingSeriesResource` — Sermon series with YouTube URLs
- `BannerResource` — Homepage carousel banners
- `GalleryResource` — Photo galleries
- `BookResource` — Books available on the Books page
- `AboutPageResource` / `CoreValueResource` — About page content & core values
- `BecomingSectionResource` — "Becoming a member" homepage section

**Courses & Bible School**
- `CourseResource` — Course catalog management
- `CourseLessonResource` — Lesson management within courses
- `CourseEnrollmentResource` — Track member enrollments
- `AttendanceResource` — Lesson attendance records
- `BibleSchoolEventResource` — Bible school-specific events
- `BibleSchoolVideoResource` / `BibleSchoolAudioResource` — Media for Bible school
- `BibleSchoolSpeakerResource` — Speaker profiles
- `BibleSchoolAccessCodeResource` / `BibleSchoolOtpTokenResource` — Access control

**Communication**
- `ContactResource` — Church contact details editor
- `ContactSubmissionResource` — Incoming contact form messages
- `NewsletterSubscriberResource` — Email list management
- `MailManagerResource` — Outgoing email management
- `VolunteerApplicationResource` — Review volunteer sign-ups
- `BabyDedicationResource` — Manage baby dedication requests
- `YouthCampingResource` / `YouthCampingRegistrationResource` — Youth camp management
- `PastoralReminderResource` — Assign and track pastoral care reminders
- `RegistrationInterestResource` — Pre-registration interest capture

**Departments & Rotas**
- `WorshipDepartmentResource` / `WorshipDepartmentMemberResource`
- `TechnicalDepartmentResource` / `TechnicalDepartmentMemberResource`
- `PreacherDepartmentResource` / `PreacherDepartmentMemberResource`
- `DepRoleResource` — Roles within departments
- `RotaResource` — Sunday service rota generation (round-robin scheduler)

**Financial**
- `GivingResource` — Donation records
- `GiftAidDeclarationResource` — UK HMRC Gift Aid declarations

**SEO & Marketing**
- `SEOSettingsResource` — Global and per-page SEO settings
- `SocialMediaPostResource` — Log of auto-posted content
- `SpamProtectionResource` — Blocked IPs and spam rules

**Compliance & Audit**
- `GdprConsentResource` / `GdprAuditLogResource` / `GdprDataRequestResource`
- `AuditTrailResource` — Full CRUD action log
- `BackupLogResource` — Database backup history

### Custom Admin Pages

| Page | Route | Purpose |
|---|---|---|
| `Dashboard` | `/admin` | Main overview dashboard |
| `LockScreen` | `/admin/lock-screen` | Session idle lock screen (Livewire) |
| `ChangePassword` | `/admin/change-password` | Forced/voluntary password change |

---

## 8. Core Feature Workflows

### 8.1 Member Registration & Onboarding

```
[Admin creates member OR visitor submits Registration Interest]
         ↓
Admin reviews RegistrationInterest in Filament
         ↓
Admin sends invitation (email with /register/{token})
         ↓
Member sets name, password on registration page
         ↓
Verification email sent → Member clicks verify link
         ↓
email_verified_at set on Member record
         ↓
Admin approves member in Filament (approved_at, approved_by)
         ↓
Member can now log in at /member/login
```

### 8.2 Course Enrollment & Learning Flow

```
[Visitor views /courses]
         ↓
Clicks course → /courses/{slug}
         ↓
Clicks "Register" → redirected to /member/login if not authenticated
         ↓
Authenticated member → /courses/{slug}/register (registration form)
         ↓
Form submitted → CourseEnrollment created (status: active)
         ↓
SMS + Email confirmation sent (CourseRegistrationConfirmation notification)
         ↓
Member visits /my-courses (dashboard)
         ↓
Selects course → /courses/{slug}/lessons (lesson list)
         ↓
Clicks lesson → /courses/{courseSlug}/lessons/{lessonSlug}
         ↓
Watches video / reads content
         ↓
If lesson has quiz → /courses/{courseSlug}/lessons/{lessonSlug}/quiz
         ↓
POST quiz answers → quiz_score saved in LessonProgress
         ↓
POST /complete → lesson marked complete (LessonProgress.completed_at)
         ↓
On course completion: if attendance >= min_attendance_for_certificate
  → Certificate issued (CourseEnrollment.certificate_issued = true)
  → Certificate downloadable at /certificate/{enrollment_id}/download
```

### 8.3 Event Management Flow

```
[Admin creates Event in Filament]
  - Sets title, dates, location, speakers (EventSpeaker pivot)
  - Optionally links to Ministry or TeamMember (event_anchor)
  - Enables requires_registration + max_attendees
         ↓
If EventObserver detects is_published change to true:
  → Social media auto-post triggered (if SOCIAL_MEDIA_AUTO_POST_EVENTS=true)
  → SocialMediaService.postEvent() called
  → Posts to enabled platforms (Facebook, Twitter, Instagram, LinkedIn)
  → SocialMediaPost record created
         ↓
Event appears on /events (published, upcoming scope)
         ↓
Visitor clicks event → /events/{slug}
  → If requires_registration → registration form shown (contact info captured)
```

### 8.4 ChurchSuite Sync Workflow

```
[Admin clicks "Transfer to ChurchSuite" on Member in Filament]
         ↓
MemberResource action calls ChurchSuiteService::transferMember($member)
         ↓
Service fetches OAuth2 token from:
  POST {CHURCHSUITE_TOKEN_URL} with client_id, client_secret
         ↓
POSTs member data to:
  POST {CHURCHSUITE_API_URL}/addressbook/contacts
         ↓
On success:
  → member.churchsuite_id = response.id
  → member.churchsuite_synced_at = now()
  → member.churchsuite_sync_status = 'synced'
On failure:
  → member.churchsuite_sync_status = 'failed'
  → member.churchsuite_sync_error = error message
```

### 8.5 Rota Generation Workflow

```
[Admin creates Rota in Filament]
  - Selects departments (worship, technical, preacher — JSON array)
  - Sets start_date and end_date
         ↓
Admin triggers "Generate Schedule" action
         ↓
RotaGeneratorService::generateWithRandomization($rota)
  1. Calculates all Sundays between start and end date
  2. For each department, fetches members and their roles
  3. Groups members by role (dep_roles)
  4. For each Sunday + each role: assigns member via round-robin index
  5. Returns schedule as nested array [date → [role → member_name]]
         ↓
Schedule stored as JSON in rotas.schedule column
         ↓
Admin can view/edit generated rota in Filament
```

### 8.6 GDPR Data Flow

```
[Member or Admin initiates GDPR data request]
         ↓
GdprDataRequest created (type: export or delete)
         ↓
GdprService::exportMemberData($member)
  - Collects: personal_info, attendance records, giving records, etc.
  - Generates JSON file + CSV exports
  - Packages into ZIP archive in storage/app/gdpr_exports/
  - Logs action in GdprAuditLog
         ↓
Admin can approve and send download link to member
         ↓
For deletion requests:
  GdprService handles anonymisation / hard deletion per retention policy
```

### 8.7 Admin Session Security Flow

```
[Admin logs in at /admin/login]
         ↓
Successful authentication → session created
         ↓
AppServiceProvider Login listener:
  → Sets user.last_login_at, user.last_login_ip
  → Calls AuditLogger::logAuthentication('login', $user)
         ↓
During session: /admin/ping called every N minutes (AJAX) to keep session alive
         ↓
If idle timeout exceeded (CheckSessionTimeout middleware):
  → session('lock_screen') flag set
  → Redirect to /admin/lock-screen
         ↓
LockScreen Livewire component shown
User enters password → POST /admin/lock (SessionController)
  → If correct: lock flag cleared, session restored
  → If wrong: error shown
```

### 8.8 Social Media Auto-Posting

```
[Event or News model saved with is_published = true]
         ↓
EventObserver / NewsObserver fires (registered in AppServiceProvider)
         ↓
SocialMediaService::postEvent() or postAnnouncement()
         ↓
For each enabled platform in config('services.social_media'):
  - Platform-specific API call (Facebook Graph, Twitter v2, Instagram Graph, LinkedIn)
  - POST content + image (if available)
         ↓
SocialMediaPost record created (success or failed status)
         ↓
Viewable / manageable in Filament SocialMediaPostResource
```

---

## 9. Third-Party Integrations

### 9.1 ChurchSuite CRM

- **Type:** OAuth2 client credentials flow
- **Endpoints:** `POST /oauth2/token`, `POST /addressbook/contacts`
- **Config:** `config/services.php → churchsuite`
- **Env vars:** `CHURCHSUITE_API_URL`, `CHURCHSUITE_TOKEN_URL`, `CHURCHSUITE_CLIENT_ID`, `CHURCHSUITE_CLIENT_SECRET`
- **Scope:** One-way sync (CityLife → ChurchSuite), member contact data
- **Service:** `App\Services\ChurchSuiteService`

### 9.2 YouTube Data API v3

- **Purpose:** Detect live streams on the CityLife Church YouTube channel
- **Channel ID:** `UCTP2_DfFmZfg5ooFu6alMvA` (default)
- **Config:** `config/services.php → youtube`
- **Env vars:** `YOUTUBE_API_KEY`, `YOUTUBE_CHANNEL_ID`
- **Service:** `App\Services\YouTubeService`
- **Methods:** `getCurrentLiveStream()`, `getUpcomingLiveStreams()`, `getRecentVideos()`

### 9.3 SMS (Vonage / Twilio)

- **Driver:** Configurable via `SMS_DRIVER` env var (`log`, `vonage`, `twilio`)
- **Config:** `config/services.php → sms`
- **Service:** `App\Services\SmsService`
- **Used for:** Course registration confirmations, pastoral notifications
- **Package:** `laravel/vonage-notification-channel`

### 9.4 Social Media Platforms

All configured in `config/services.php` with feature flags:

| Platform | Env Flag | API Type |
|---|---|---|
| Facebook | `FACEBOOK_ENABLED` | Facebook Graph API (page posts) |
| Twitter/X | `TWITTER_ENABLED` | Twitter API v2 (tweet creation) |
| Instagram | `INSTAGRAM_ENABLED` | Instagram Graph API |
| LinkedIn | `LINKEDIN_ENABLED` | LinkedIn Marketing API (organization posts) |

- **Service:** `App\Services\SocialMediaService`
- **Auto-posting:** Controlled by `SOCIAL_MEDIA_AUTO_POST_EVENTS`, `SOCIAL_MEDIA_AUTO_POST_ANNOUNCEMENTS`

### 9.5 Google Analytics

- **Env vars:** `GOOGLE_ANALYTICS_ID`, `GOOGLE_ANALYTICS_ENABLED`
- **Config:** `config/services.php → google_analytics`
- **Integration:** Via cookie consent system — GA script injected only if analytics cookie accepted

### 9.6 AWS S3 (File Storage)

- **Package:** `league/flysystem-aws-s3-v3`
- **Env vars:** `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`
- **Used for:** All uploaded media (images, audio files, documents, GDPR exports)
- **Proxy route:** `GET /storage/{path}` — serves S3 files with CORS headers for Filament file previews

### 9.7 Email (SMTP)

- **Mailers:** SMTP (Gmail), Postmark, Resend (all configurable)
- **Env vars:** `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`
- **Used for:** Member registration invites, email verification, course confirmations, GDPR export links, newsletter

### 9.8 Google APIs Client Library

- **Package:** `google/apiclient`
- **Used by:** YouTubeService for API calls

---

## 10. Background Services & Automation

### Scheduled Commands (`routes/console.php`)

The app uses Laravel's scheduler for periodic tasks. Commands are registered in the `Console/` directory and scheduled via `routes/console.php` (Laravel 12 style).

### Observer-Based Automation

| Observer | Model | Trigger | Action |
|---|---|---|---|
| `EventObserver` | `Event` | `created` / `updated` (is_published → true) | `SocialMediaService::postEvent()` |
| `NewsObserver` | `News` | `created` / `updated` (is_published → true) | `SocialMediaService::postAnnouncement()` |

### Services Summary

| Service | Responsibilities |
|---|---|
| `ChurchSuiteService` | OAuth2 token management, member sync to ChurchSuite |
| `YouTubeService` | Live stream detection, recent video fetching from YouTube |
| `SocialMediaService` | Multi-platform social posting (FB, Twitter, IG, LinkedIn) |
| `SmsService` | Send SMS via Vonage or Twilio, fallback to log driver |
| `GdprService` | Data export/deletion, GDPR audit logging |
| `RotaGeneratorService` | Sunday rota generation via round-robin scheduling |
| `SEOService` | Generate and inject SEO meta tags per page |
| `CookieConsentService` | GDPR cookie consent management, analytics opt-in |
| `AuditLogger` | Write structured entries to `audit_trails` table |
| `BackupService` | Database backup orchestration, logs to `backup_logs` |

---

## 11. Security & Compliance

### OWASP / Security Measures

- **Injection:** All DB queries use Eloquent ORM / query builder with parameterized queries. No raw user input in SQL.
- **XSS:** Blade templates use `{{ }}` (auto-escaped) by default; `{!! !!}` used only for trusted admin-controlled HTML.
- **CSRF:** All state-changing forms use Laravel CSRF tokens (`@csrf`).
- **Authentication:** Separate guards for staff and members prevent privilege escalation across user types.
- **Session Security:** `EnsureConsistentSession` / `ForceSessionConsistency` middleware prevents session fixation. Session idle timeout + lock screen for admin.
- **Spam Protection:** `BlockedIp` model + `SpamProtectionResource`; contact submissions checked for spam signals.
- **Rate Limiting:** Laravel's built-in throttle middleware applies to login endpoints.
- **IP Blocking:** Admin can manually block IPs via `BlockedIp` model.
- **Password Security:** Hashed using Laravel's `bcrypt` via `password` cast on both `User` and `Member` models.
- **Forced Password Change:** `force_password_change` flag on `User` triggers `ForcePasswordChange` middleware redirect.
- **File Upload Safety:** Uploads are stored to S3 (no direct public execution path); file serving proxied through Laravel with MIME validation.

### GDPR Compliance

- Cookie consent banner with granular control (`CookieConsentService`)
- Consent recorded in DB (`GdprConsent` table) with IP address and timestamp
- Google Analytics only loads if analytics cookie accepted
- Data export: members/admins can request full data export (JSON + CSV + ZIP)
- Data deletion: deletion requests tracked and actioned via `GdprService`
- Audit logging: all GDPR-related actions logged in `GdprAuditLog`
- Member data fields: `gdpr_consent`, `gdpr_consent_date`, `gdpr_consent_ip`, `newsletter_consent`
- Privacy policy page at `/privacy-policy`
- Cookie policy page at `/cookie-policy`

### Audit Trail

- `AuditTrail` model captures: `user_id`, `action`, `model_type`, `model_id`, `old_values`, `new_values`, IP address
- `Auditable` trait auto-hooks into Eloquent model events for `User`
- `AuditLogger::logAuthentication()` called on every staff login
- Viewable in Filament `AuditTrailResource`

---

## 12. Deployment & Infrastructure

### Production Environment

| Component | Provider |
|---|---|
| **Hosting** | Laravel Cloud |
| **Database** | MySQL (auto-provisioned by Laravel Cloud) |
| **Cache / Queue** | Redis (auto-provisioned by Laravel Cloud) |
| **File Storage** | AWS S3 |
| **DNS / Domain** | Custom domain or `*.laravel.cloud` subdomain |

### Deployment Workflow

```
1. Push code to GitHub (master branch)
2. Laravel Cloud auto-deploys (CI/CD)
3. Build step executes:
   - composer install --optimize-autoloader --no-dev
   - php artisan config:cache
   - php artisan route:cache
   - php artisan view:cache
   - npm install && npm run build (Vite)
4. Database migrations: php artisan migrate --force
5. Application goes live
```

### Environment Variables (Critical)

```bash
APP_NAME="City Life Church"
APP_ENV=production
APP_KEY=base64:...            # Generated with: php artisan key:generate
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database (auto-set by Laravel Cloud)
DB_CONNECTION=mysql
DB_HOST=...

# Storage
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=

# Mail
MAIL_MAILER=smtp
MAIL_FROM_ADDRESS=noreply@citylifecc.com
MAIL_FROM_NAME="City Life Church"

# SMS
SMS_DRIVER=vonage
VONAGE_API_KEY=
VONAGE_API_SECRET=
VONAGE_FROM=CityLife

# YouTube
YOUTUBE_API_KEY=
YOUTUBE_CHANNEL_ID=UCTP2_DfFmZfg5ooFu6alMvA

# ChurchSuite
CHURCHSUITE_CLIENT_ID=
CHURCHSUITE_CLIENT_SECRET=

# Social Media (optional, feature-flagged)
FACEBOOK_ENABLED=false
TWITTER_ENABLED=false
INSTAGRAM_ENABLED=false
LINKEDIN_ENABLED=false
SOCIAL_MEDIA_AUTO_POST_ENABLED=false

# Google Analytics
GOOGLE_ANALYTICS_ENABLED=false
GOOGLE_ANALYTICS_ID=
```

### Alternative Deployment (Heroku-compatible)

- `Procfile` present for Heroku/Sevalla style deployments
- `cloud.toml` for Laravel Cloud configuration
- `build.sh` — custom build script

---

## 13. Known Limitations & V2 Improvement Areas

Based on the current implementation, the following areas are candidates for improvement or rebuilding in Version 2:

### Architecture
- **No API layer:** The entire app is server-rendered with Blade. V2 could benefit from a RESTful or GraphQL API to support a mobile app or separate frontend.
- **Single monolith:** All features (CMS, member portal, admin, course LMS) live in one Laravel app. V2 could consider microservices or at least a modular architecture (Laravel Modules).
- **No real-time features:** Livewire is used minimally (lock screen, modals). V2 could use Laravel Reverb / WebSockets for real-time notifications, live attendance tracking, etc.

### Member Portal
- **Limited member self-service:** Members can only manage profile and courses. V2 could add: giving history view, small group management, event RSVP, prayer wall, chat/messaging.
- **No mobile app:** A companion React Native or Flutter app consuming a Laravel API would greatly improve member engagement.
- **Password reset missing:** There is no self-service password reset flow for members (only admin-assisted).

### Courses / LMS
- **No video hosting:** All videos are YouTube embeds. V2 could integrate with Vimeo or use S3 + video streaming for a more controlled experience.
- **No discussion forums per course:** Members cannot interact on lessons.
- **Certificate design is basic:** V2 could use dynamic PDF generation (DomPDF / Browsershot) with a branded template.
- **No assignment/file submission system:** Lessons only support quizzes.

### Communication
- **Email templates are plain:** V2 should use a proper transactional email design system (e.g., React Email, MJML).
- **Newsletter subscriber list has no campaigns:** The newsletter subscriber table exists but there is no built-in email campaign builder. V2 should integrate Mailchimp, MailerLite, or build a campaign system.
- **ChurchSuite sync is one-directional (push only):** V2 should support bidirectional sync (pull members from ChurchSuite into CityLife).

### Admin Panel
- **No analytics dashboard charts:** The widgets show counts/lists but no visual charts. V2 should use Filament's chart widgets (ApexCharts or Chart.js) for trends and visualisations.
- **Backup system is manual:** `BackupLog` exists but backup orchestration is not automated. V2 should use `spatie/laravel-backup` with S3 storage and scheduled runs.
- **GDPR deletion is not fully automated:** V2 should automate data retention policies with scheduled cleanup.

### SEO & Performance
- **No server-side caching of rendered HTML:** V2 could add full-page cache for public pages (Laravel's response cache package).
- **Images are not optimised on upload:** V2 should process uploaded images (resize, WebP conversion) via Spatie Image or Intervention Image.
- **No sitemap generation:** V2 should auto-generate `sitemap.xml` using `spatie/laravel-sitemap`.

### Testing
- **Test coverage is sparse:** `tests/Feature/` and `tests/Unit/` exist but coverage is not enforced. V2 should target ≥80% coverage and run tests in CI.

### Internationalisation
- **English only:** V2 could add i18n support for a multi-language church audience using Laravel's localisation system.

### Social Media
- **Access tokens expire:** The current social media integration requires manually refreshing long-lived tokens. V2 should implement a proper OAuth refresh token flow with token storage in the database.

---

*This document was auto-generated from the CityLife codebase on 23 March 2026.*
*Use it as the definitive reference when building Version 2.*
