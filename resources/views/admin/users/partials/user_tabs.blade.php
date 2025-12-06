<ul class="nav nav-tabs nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link active" id="teams-member-tab" data-bs-toggle="tab" href="#teams-member" aria-controls="teams-member" role="tab"
            aria-selected="true">
            <i class="bx bx-group me-1"></i>@lang('admin.teams_member')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="teams-lead-tab" data-bs-toggle="tab" href="#teams-lead" aria-controls="teams-lead" role="tab"
            aria-selected="true">
            <i class="bx bx-group me-1"></i>@lang('admin.teams_lead')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tasks-tab" data-bs-toggle="tab" href="#tasks" aria-controls="tasks" role="tab"
            aria-selected="false">
            <i class="bx bx-task me-1"></i>@lang('admin.tasks')
        </a>
    </li>
</ul>
<div class="tab-content" style="padding: 0px">
    <div class="tab-pane active" id="teams-member" aria-labelledby="teams-member-tab" role="tabpanel">
        @include('admin.users.partials.teams-member')
    </div>
    <div class="tab-pane" id="teams-lead" aria-labelledby="teams-lead-tab" role="tabpanel">
        @include('admin.users.partials.teams-lead')
    </div>
    <div class="tab-pane" id="tasks" aria-labelledby="tasks-tab" role="tabpanel">
        @include('admin.users.partials.tasks')
    </div>
</div>
