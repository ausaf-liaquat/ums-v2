<div class="card">
    <div class="card-body">
        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 0%</small> --}}
        <div class="d-flex p-4 pt-3">
            <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('assets/assets/img/icons/unicons/wallet.png') }}" alt="User">
            </div>
            <div>
                <small class="text-muted d-block">Total Balance</small>
                <div class="d-flex align-items-center">
                    <h6 class="mb-0 me-1">${{ auth()->user()->balanceFloatNum }}</h6>
                    <small class="text-success fw-semibold">
                        <i class="bx bx-chevron-up"></i>
                        42.9%
                    </small>
                    <input type="hidden" id="current_balance" name="current_balance"
                        value="{{ auth()->user()->balanceFloatNum }}">
                </div>
            </div>
        </div>
    </div>
</div>
