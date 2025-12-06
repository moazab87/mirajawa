<ul class="nav nav-tabs nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link active" id="projects-tab" data-bs-toggle="tab" href="#projects" aria-controls="projects" role="tab"
            aria-selected="true">
            <i class="bx bx-briefcase me-1"></i>@lang('admin.projects')
        </a>
    </li>
</ul>
<div class="tab-content" style="padding: 0px">
    <div class="tab-pane active" id="projects" aria-labelledby="projects-tab" role="tabpanel">
        @include('admin.clients.partials.projects')
    </div>
</div>
