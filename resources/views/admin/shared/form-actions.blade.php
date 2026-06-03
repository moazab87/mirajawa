{{-- Legacy include: prefer <x-admin.form-actions /> in new templates --}}
<x-admin.form-actions :submit-text="$submitText ?? __('dashboard.save')" :back-url="$backUrl ?? null" />
