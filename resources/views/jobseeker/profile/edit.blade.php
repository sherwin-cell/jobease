@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <!-- Main profile -->
        <div>
            <label>Headline</label>
            <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}">
        </div>

        <div>
            <label>Bio</label>
            <textarea name="bio">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <div>
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $profile->location) }}">
        </div>

        <div>
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}">
        </div>

        <div>
            <label>Website</label>
            <input type="url" name="website" value="{{ old('website', $profile->website) }}">
        </div>

        <!-- Skills -->
        <div>
            <label>Skills</label>
            <select name="skills[]" multiple>
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}"
                        @if($profile->skills->contains($skill->id)) selected @endif
                    >{{ $skill->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Experiences, Education, Certifications, Interests -->
        <!-- Use JavaScript to dynamically add/remove fields -->
        <!-- Example for experiences -->
        <div id="experiences">
            <h3>Experiences</h3>
            @foreach($profile->experiences as $i => $exp)
            <div>
                <input type="text" name="experiences[{{ $i }}][title]" value="{{ $exp->title }}" placeholder="Title">
                <input type="text" name="experiences[{{ $i }}][company]" value="{{ $exp->company }}" placeholder="Company">
                <input type="date" name="experiences[{{ $i }}][start_date]" value="{{ $exp->start_date }}">
                <input type="date" name="experiences[{{ $i }}][end_date]" value="{{ $exp->end_date }}">
                <textarea name="experiences[{{ $i }}][description]">{{ $exp->description }}</textarea>
            </div>
            @endforeach
        </div>

        <button type="submit">Save Profile</button>
    </form>
</div>
@endsection