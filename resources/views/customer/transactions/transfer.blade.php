<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Transfer Funds</h2>
            <p class="text-sm text-gray-500 mt-1">Send money to another account</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">

                {{-- Icon + title --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">New Transfer</p>
                        <p class="text-xs text-gray-400">Transfers are processed immediately</p>
                    </div>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('transfer.submit') }}" id="transferForm">
                    @csrf

                    {{-- From account --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Account</label>
                        <select name="from_account_id" id="from_account_id"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->account_number }} — ₱{{ number_format($account->balance, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- To account number --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Account Number</label>
                        <input type="text" name="to_account_number" id="to_account_number"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                            placeholder="e.g. ACC-XXXXXXXX"
                            value="{{ old('to_account_number') }}">
                    </div>

                    {{-- Amount --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">₱</span>
                            <input type="number" name="amount" id="amount" step="0.01" min="0.01"
                                class="w-full border border-gray-200 rounded-lg pl-7 pr-3 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                placeholder="0.00"
                                value="{{ old('amount') }}">
                        </div>
                    </div>

                    <button type="button" onclick="openModal()"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 rounded-lg shadow transition">
                        Review Transfer
                    </button>

                </form>
            </div>
        </div>
    </div>

    {{-- Confirmation Modal --}}
    <div id="confirmModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm mx-4">

            {{-- Modal header --}}
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Confirm Transfer</h3>
                    <p class="text-xs text-gray-400">Please review before proceeding</p>
                </div>
            </div>

            {{-- Transfer details --}}
            <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 space-y-3 mb-5 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">To Account</span>
                    <span id="modal-to" class="font-mono font-medium text-gray-800"></span>
                </div>
                <div class="border-t border-gray-200"></div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Amount</span>
                    <span id="modal-amount" class="font-bold text-blue-600 text-base"></span>
                </div>
            </div>

            <p class="text-xs text-gray-400 mb-5 text-center">This action cannot be undone once submitted.</p>

            <div class="flex gap-3">
                <button type="button" onclick="closeModal()"
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2.5 rounded-lg transition">
                    Cancel
                </button>
                <button type="button" onclick="submitTransfer()"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-lg shadow transition">
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

        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</x-app-layout>