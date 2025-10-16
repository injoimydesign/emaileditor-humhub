# HumHub Email Template Editor Plugin

Version: 1.0.0  
Compatible with: HumHub 1.17.x

## Description

This plugin allows administrators to customize email templates directly from the HumHub admin interface without modifying core files.

## Features

- ✉️ Edit all system email templates
- 🎨 Live preview of email changes with sample data
- 🔄 Reset templates to defaults
- 📧 Pre-populated with HumHub's default email content
- 💾 Database-backed template storage
- 🌍 Multi-language support ready
- **🎨 NEW: Visual Email Style Designer**
  - Customize email colors (primary, background, text, links, buttons)
  - HumHub's native rich text editor for headers and footers
  - Custom CSS editor for advanced styling
  - **Logo management with 3 options:**
    - Upload custom logo for emails
    - Use HumHub appearance logo automatically
    - Enter logo URL manually
  - Live preview with real-time updates
  - Export/import style configurations
  - **Color variables for dynamic styling** ({primary_color}, {background_color}, etc.)
  - Use color variables in headers, footers, and custom CSS
  - Separate admin menu section
- **🔔 NEW: Notification Settings Manager**
  - Control notification channels (Email, Web, Mobile, Desktop)
  - Enable/disable notifications per type
  - User override permissions
  - Bulk update functionality
  - Organized by category (Content, Social, Spaces, System)
  - 12 configurable notification types

**Access the new features:**
   - Email Templates: Administration → Settings → Email Templates
   - Email Style Designer: Administration → Settings → Email Style Designer

## Installation

1. Download the plugin files
2. Extract to `protected/modules/emailtemplates/`
3. Enable the module in Administration → Modules
4. Configure templates in Administration → Settings → Email Templates

## Available Templates

1. **General Notification** - Standard notifications
2. **New Comment Notification** - When someone comments on content
3. **New Like Notification** - When someone likes content
4. **Space Invitation** - Inviting users to spaces
5. **Space Member Added** - When a user is added to a space
6. **Space Membership Request** - When someone requests to join a space
7. **Space Membership Approved** - When membership request is approved
8. **Space Membership Declined** - When membership request is declined
9. **New Content in Space** - When new content is posted in a space
10. **User Invitation** - Inviting new users to the platform
11. **Password Recovery** - Password reset emails
12. **Welcome Email** - New user welcome messages
13. **New Follower Notification** - When someone follows you
14. **Mention Notification** - When someone mentions you

## Usage

Navigate to **Administration → Settings → Email Templates** to:
- Select a template to edit
- Modify the subject and body
- Use available placeholders (e.g., {displayName}, {contentTitle})
- Preview your changes
- Save or reset to defaults

## Requirements

- HumHub 1.17.x
- PHP 7.4 or higher

## Changelog

### Version 1.2.0 (Notification Settings Manager)
- **NEW: Notification Settings Manager** - Complete control over notification channels
- Configure Email, Web, Mobile, and Desktop notifications
- 12 notification types across 4 categories
- User override permission control
- Bulk update functionality
- Individual notification editing
- New database table for notification settings
- Third migration file
- New admin menu entry "Notification Settings"
- Organized by category (Content, Social, Spaces, System)
- **Updated all default email templates with HumHub's original HTML structure**
- All templates now use HumHub's Foundation-based email framework
- Proper responsive email design with table layouts
- Consistent styling across all notification types

### Version 1.1.0 (Email Style Designer)
- **NEW: Visual Email Style Designer** - Complete email branding customization
- Visual HTML editor (TinyMCE) for headers and footers
- Color picker for 6 different email color schemes
- Custom CSS editor for advanced styling
- Logo URL configuration
- Live preview with real-time updates
- Export/import style configurations
- Separate admin menu section
- New database table for style storage
- Additional migration file

### Version 1.0.0 (Initial Release)
- Basic email template editing functionality
- Template selection interface
- Placeholder support with expanded placeholders
- Reset to defaults feature
- Database migration for template storage
- Admin menu integration
- Preview functionality with subject line
- Pre-populated with HumHub default email content
- 9 email templates included

### Updates in Version 1.1.0
- Added EmailStyle model for managing visual styles
- Added StyleController for style management
- New admin menu entry "Email Style Designer"
- TinyMCE integration for WYSIWYG editing
- Real-time preview with iframe
- Color picker inputs for easy color selection
- Export functionality for style backup
- Updated Events.php to include new menu entry
- Updated translations for new features

## Installation

### Option 1: Download ZIP File (Recommended)
1. Open the "HumHub Email Templates Plugin - Download Package" artifact
2. Click the "Download Complete Plugin (ZIP)" button
3. Extract the ZIP file - you'll get an `emailtemplates` folder
4. Copy the `emailtemplates` folder to `protected/modules/` in your HumHub installation
5. Run the migration:
   ```bash
   php yii migrate/up --migrationPath=@humhub/modules/emailtemplates/migrations
   ```
6. Enable the module in Administration → Modules
7. Configure templates in Administration → Settings → Email Templates

## File Structure

Navigate to **Administration → Settings → Email Templates** to:
- Select a template to edit
- Modify the subject and body
- Use available placeholders (e.g., {displayName}, {contentTitle})
- Preview your changes
- Save or reset to defaults

## File Structure

```
protected/modules/emailtemplates/
├── Module.php
├── Events.php
├── config.php
├── module.json
├── controllers/
│   ├── AdminController.php
│   └── StyleController.php          ← NEW
├── models/
│   ├── EmailTemplate.php
│   └── EmailStyle.php                ← NEW
├── migrations/
│   ├── m000000_000000_initial.php
│   └── m000000_000001_email_style.php  ← NEW
├── views/
│   ├── admin/
│   │   ├── index.php
│   │   ├── edit.php
│   │   └── preview.php
│   └── style/                        ← NEW
│       ├── index.php
│       └── preview.php
└── messages/
    └── en/
        └── base.php
```

## Usage

Navigate to **Administration → Settings → Email Templates** to:

### Version 1.0.0 (Initial Release)
- Basic email template editing functionality
- Template selection interface
- Placeholder support with expanded placeholders
- Reset to defaults feature
- Database migration for template storage
- Admin menu integration
- Preview functionality with subject line
- Pre-populated with HumHub default email content
- 9 email templates included

### Updates in this version
- Added default email subjects and bodies matching HumHub's current templates
- Expanded placeholder support: {siteName}, {author}, {originator}, {message}, etc.
- Preview now shows both subject and body
- More comprehensive template coverage
- **Fixed preview modal loading issues** - Now correctly loads the selected template
- **Added accessibility features** - ARIA labels, keyboard navigation support
- **Enhanced modal with Close button** - Better UX with visible close button and icon
- **Loading states** - Shows spinner while preview loads
- **Error handling** - Displays error message if preview fails to load
- **Modal cleanup** - Clears content when closed to prevent stale data
