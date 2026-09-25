<div class="flex items-center gap-x-1">
    @if ($model->status == 0)
        <span class='badge badge-pill alert-table badge-warning'> {{__('admin.NewTransaction')}} </span>
    @elseif ($model->status == 1)
        <span class='badge badge-pill alert-table badge-info'> {{__('admin.InReviewRequest')}} </span>
    @elseif ($model->status == 2)
        <span class='badge badge-pill alert-table badge-primary'> {{__('admin.ContactedRequest')}} </span>
    @elseif ($model->status == 3)
        <span class='badge badge-pill alert-table badge-danger'>{{__('admin.ReviewedRequest')}} </span>
    @elseif ($model->status == 4)
        <span class='badge badge-pill alert-table badge-success'>{{__('admin.FinishedRequest')}} </span>
    @elseif ($model->status == 5)
        <span class='badge badge-pill alert-table badge-warning'> {{__('admin.PendingRequest')}} </span>
    @elseif ($model->status == 6)
        <span class='badge badge-pill alert-table badge-warning'> {{__('admin.Cancelled')}} </span>
    @elseif ($model->status == 7)
        <span class='badge badge-pill alert-table badge-secondary'> {{__('admin.UnderObservationRequest')}} </span>
    @elseif ($model->status == 8)
        <span class='badge badge-pill alert-table badge-primary'> {{__('admin.UnderEvaluationRequest')}} </span>
    @elseif ($model->status == 9)
        <span class='badge badge-pill alert-table badge-info'> {{__('admin.UnderReviewWorkflowRequest')}} </span>
    @endif

    @if($model->status != 4 || auth()->user()->hasRole('super-admin'))
        <x-button.circle wire:click="$dispatchTo('evaluation-transaction','editStatus', {'model':{{$model}}})" icon="pencil"></x-button.circle>
    @endif
</div>
