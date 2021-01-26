<div class="flex space-x-1 justify-around">
    @if($tableConfiguration->viewAction)
        @include('tall-resources::actions.view', ['action' => $tableConfiguration->viewAction])
    @endif

    @if($tableConfiguration->editAction)
        @include('tall-resources::actions.edit', ['action' => $tableConfiguration->editAction])
    @endif

    @if($tableConfiguration->deleteAction)
        @include('tall-resources::actions.delete', ['action' => $tableConfiguration->deleteAction])
    @endif
</div>