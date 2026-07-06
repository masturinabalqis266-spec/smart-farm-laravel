<div class="mb-5">
    <label class="block font-semibold mb-2">Pest Name</label>
    <input type="text"
           name="pest_name"
           value="{{ old('pest_name', $pest->pest_name ?? '') }}"
           class="w-full border rounded-lg px-4 py-2"
           required>
</div>

<div class="mb-5">
    <label class="block font-semibold mb-2">Threat Level</label>
    <select name="threat_level"
            class="w-full border rounded-lg px-4 py-2"
            required>
        <option value="Low" {{ old('threat_level', $pest->threat_level ?? '') == 'Low' ? 'selected' : '' }}>
            Low
        </option>

        <option value="Medium" {{ old('threat_level', $pest->threat_level ?? '') == 'Medium' ? 'selected' : '' }}>
            Medium
        </option>

        <option value="High" {{ old('threat_level', $pest->threat_level ?? '') == 'High' ? 'selected' : '' }}>
            High
        </option>
    </select>
</div>

<div class="mb-5">
    <label class="block font-semibold mb-2">Treatment</label>
    <textarea name="treatment"
              rows="4"
              class="w-full border rounded-lg px-4 py-2">{{ old('treatment', $pest->treatment ?? '') }}</textarea>
</div>

<div class="mb-5">
    <label class="block font-semibold mb-2">Location / Farm Zone</label>
    <input type="text"
           name="location"
           value="{{ old('location', $pest->location ?? '') }}"
           placeholder="Block A"
           class="w-full border rounded-lg px-4 py-2">
</div>

<div class="mb-6">
    <label class="block font-semibold mb-2">
        Detection Count
    </label>

    <input
        type="number"
        value="{{ old('detection_count', $pest->detection_count ?? 0) }}"
        readonly
        class="w-full bg-gray-100 border rounded-lg px-4 py-2 cursor-not-allowed">

    <!-- Hidden input so the value is still submitted with the form -->
    <input
        type="hidden"
        name="detection_count"
        value="{{ old('detection_count', $pest->detection_count ?? 0) }}">

    <p class="text-sm text-gray-500 mt-2">
        This value is updated automatically whenever a worker submits a pest report or the AI detects this pest.
    </p>
</div>