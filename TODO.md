# TODO: Fix Voucher Usage Issue for Alumni and Siswa

## Problem
Only the first created account (e.g., first alumni or siswa) can use vouchers. Subsequent accounts cannot use the same voucher, even though they should be able to use it once each.

## Root Cause
The voucher system has a total usage limit that prevents multiple users from using the same voucher. Once one user uses it, the voucher becomes inactive for all others.

## Solution
Remove the total usage limit from voucher logic, allowing unlimited total uses but one use per user.

## Steps
- [ ] Modify Voucher.php to remove total usage checks from isActive() and isExpired()
- [ ] Update scopeActive() and scopeExpired() to remove total usage conditions
- [ ] Modify VoucherController.php useVoucher() method to remove total usage limit check
- [ ] Test the changes to ensure each user can use the voucher once

## Files to Edit
- app/Models/Voucher.php
- app/Http/Controllers/VoucherController.php
