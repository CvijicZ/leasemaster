@extends('layouts.admin')

@section('admin-content')
    <!-- Main Content -->
    <div class="col-md-9 col-lg-10 p-4">
        <h2 class="text-custom-primary">Settings</h2>
        <form method="POST">
            @csrf

            <!-- General Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm">
                <div class="card-header">
                    <h5><i class="fa-solid fa-cogs"></i> General Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="site_title" class="form-label">Site Title</label>
                        <input type="text" class="form-control" id="site_title" name="site_title"
                            value="{{ old('site_title', 'My Website') }}">
                    </div>
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description', 'This is a placeholder description for your site.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Theme Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fa-solid fa-palette"></i> Theme Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="default_theme" class="form-label">Default Theme for Users</label>
                        <select class="form-select" id="default_theme" name="default_theme">
                            <option value="light" {{ old('default_theme', 'light') == 'light' ? 'selected' : '' }}>Light
                                Mode</option>
                            <option value="dark" {{ old('default_theme', 'light') == 'dark' ? 'selected' : '' }}>Dark Mode
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Site Status Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fa-solid fa-toggle-on"></i> Site Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="site_status" class="form-label">Enable/Disable Site</label>
                        <select class="form-select" id="site_status" name="site_status">
                            <option value="enabled" {{ old('site_status', 'enabled') == 'enabled' ? 'selected' : '' }}>
                                Enabled</option>
                            <option value="disabled" {{ old('site_status', 'enabled') == 'disabled' ? 'selected' : '' }}>
                                Disabled</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Logo Upload Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fa-solid fa-image"></i> Logo Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="site_logo" class="form-label">Site Logo (Upload Image)</label>
                        <input type="file" class="form-control" id="site_logo" name="site_logo">
                        <small class="form-text text-muted">Upload your logo image here (PNG, JPG, or SVG).</small>
                    </div>
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fa-solid fa-envelope"></i> Contact Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control" id="contact_email" name="contact_email"
                            value="{{ old('contact_email', 'admin@example.com') }}">
                    </div>
                    <div class="mb-3">
                        <label for="support_phone" class="form-label">Support Phone</label>
                        <input type="text" class="form-control" id="support_phone" name="support_phone"
                            value="{{ old('support_phone', '123-456-7890') }}">
                    </div>
                </div>
            </div>

            <!-- Social Media Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fa-solid fa-share-alt"></i> Social Media Links</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="facebook_url" class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                            value="{{ old('facebook_url', 'https://facebook.com') }}">
                    </div>
                    <div class="mb-3">
                        <label for="twitter_url" class="form-label">Twitter URL</label>
                        <input type="url" class="form-control" id="twitter_url" name="twitter_url"
                            value="{{ old('twitter_url', 'https://twitter.com') }}">
                    </div>
                    <div class="mb-3">
                        <label for="instagram_url" class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" id="instagram_url" name="instagram_url"
                            value="{{ old('instagram_url', 'https://instagram.com') }}">
                    </div>
                </div>
            </div>

            <!-- Default Language Settings -->
            <div class="card bg-custom-secondary text-custom-primary shadow-sm mt-4">
                <div class="card-header">
                    <h5><i class="fa-solid fa-language"></i> Default Language</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="default_language" class="form-label">Default Language</label>
                        <select class="form-select" id="default_language" name="default_language">
                            <option value="en" {{ old('default_language', 'en') == 'en' ? 'selected' : '' }}>English
                            </option>
                            <option value="es" {{ old('default_language', 'en') == 'es' ? 'selected' : '' }}>Spanish
                            </option>
                            <option value="fr" {{ old('default_language', 'en') == 'fr' ? 'selected' : '' }}>French
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
