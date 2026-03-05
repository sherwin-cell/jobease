@extends('layouts.app') <!-- This uses your existing layout -->

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Candidate Search</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('candidates.index') }}" class="mb-6 flex flex-wrap gap-2">
            <select name="skills[]" multiple class="border rounded p-2">
                @foreach($allSkills as $skill)
                    <option value="{{ $skill->id }}" {{ in_array($skill->id, (array) request('skills')) ? 'selected' : '' }}>
                        {{ $skill->name }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="experience" placeholder="Min Experience" value="{{ request('experience') }}"
                class="border rounded p-2">

            <input type="text" name="location" placeholder="Location" value="{{ request('location') }}"
                class="border rounded p-2">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Search
            </button>
        </form>

        <!-- Candidate Table -->
        <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Skills</th>
                    <th class="border px-2 py-1">Experience</th>
                    <th class="border px-2 py-1">Location</th>
                    <th class="border px-2 py-1">Status</th>
                    <th class="border px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidates as $candidate)
                    <tr>
                        <td class="border px-2 py-1">{{ $candidate->name }}</td>
                        <td class="border px-2 py-1">{{ $candidate->skills->pluck('name')->join(', ') }}</td>
                        <td class="border px-2 py-1">{{ $candidate->experience }} yrs</td>
                        <td class="border px-2 py-1">{{ $candidate->location }}</td>
                        <td class="border px-2 py-1 capitalize">{{ $candidate->status }}</td>
                        <td class="border px-2 py-1 flex gap-1">
                            <form method="POST" action="{{ route('candidates.updateStatus', $candidate) }}">
                                @csrf
                                <input type="hidden" name="status" value="shortlisted">
                                <button type="submit"
                                    class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Shortlist</button>
                            </form>

                            <form method="POST" action="{{ route('candidates.updateStatus', $candidate) }}">
                                @csrf
                                <input type="hidden" name="status" value="interview">
                                <button type="submit"
                                    class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Interview</button>
                            </form>

                            <form method="POST" action="{{ route('candidates.updateStatus', $candidate) }}">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit"
                                    class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $candidates->withQueryString()->links() }}
    </div>
@endsection