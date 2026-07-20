<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transfer Funds
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('transfer.submit') }}" id="transferForm">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">From Account</label>
                        <select name="from_account_id" id="from_account_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->account_number }} — ₱{{ number_format($account->balance, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">To Account Number</label>
                        <input type="text" name="to_account_number" id="to_account_number"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. ACC-XXXXXXXX" value="{{ old('to_account_number') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Amount (₱)</label>
                        <input type="number" name="amount" id="amount" step="0.01" min="0.01"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('amount') }}">
                    </div>

                    {{-- This button opens the modal instead of submitting directly --}}
                    <button type="button" onclick="openModal()"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Transfer
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Confirmation Modal --}}
    <div id="confirmModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm mx-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirm Transfer</h3>

            <div class="text-sm text-gray-600 space-y-2 mb-6">
                <p><span class="font-medium">To Account:</span> <span id="modal-to" class="text-gray-900"></span></p>
                <p><span class="font-medium">Amount:</span> <span id="modal-amount" class="text-gray-900 font-semibold"></span></p>
            </div>

            <p class="text-sm text-gray-500 mb-6">Are you sure you want to proceed with this transfer? This action cannot be undone.</p>

            <div class="flex gap-3">
                <button type="button" onclick="closeModal()"
                    class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-200 text-sm">
                    Cancel
                </button>
                <button type="button" onclick="submitTransfer()"
                    class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 text-sm">
                    Yes, Transfer
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            const to = document.getElementById('to_account_number').value.trim();
            const amount = document.getElementById('amount').value.trim();

            if (!to || !amount) {
                alert('Please fill in all fields before proceeding.');
                return;
            }

            document.getElementById('modal-to').textContent = to;
            document.getElementById('modal-amount').textContent = '₱' + parseFloat(amount).toLocaleString('en-PH', { minimumFractionDigits: 2 });

            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function submitTransfer() {
            document.getElementById('transferForm').submit();
        }

        // Close modal when clicking outside
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</x-app-layout>