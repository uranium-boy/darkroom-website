<form action="{{ route('darkrooms.names') }}" method="GET" class="max-w-sm mx-auto mb-2">
    <label for="darkrooms-dropdown" class="block mb-2">Select a Darkroom:</label>
    <select class="block w-1/3 px-4 py-2 bg-gray-800 border border-gray-500 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-gray-800 transition ease-in-out duration-150" id="darkrooms-dropdown">
    </select>
</form>

<div id="calendar"
     data-is-editable="{{ $isEditable }}"></div>
