{{-- mainPermissions --}}
<div class="card-body">
    <h4 class="card-title">@lang('admin.Permissions')</h4>
    <p class="card-description"></p>
    <ul class="flex flex-wrap" id="pills-tab" role="tablist">

        @if (!empty($mainPermissions))
            @php
                $i = 0;
            @endphp
            @foreach ($mainPermissions as $mainPermission)
                <li class="mr-2">
                    <a class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-gray-900
                        {{ $i == 0 ? 'bg-blue-200' : '' }}" id="pills-{{ $mainPermission->id }}-tab"
                       href="#pills-{{ $mainPermission->id }}" role="tab"
                       aria-controls="pills-{{ $mainPermission->id }}" aria-selected="{{ $i == 0 ? 'true' : 'false' }}">
                        {{ __('admin.' . $mainPermission->title) }}
                    </a>
                </li>
                @php
                    $i++;
                @endphp
            @endforeach

        @endif
    </ul>
    <div class="flex flex-col space-y-4" id="pills-tabContent">

        @if (!empty($mainPermissions))
            @php
                $i = 0;
            @endphp
            @foreach ($mainPermissions as $mainPermission)
                <div class="{{ $i == 0 ? 'block' : 'hidden' }}" id="pills-{{ $mainPermission->id }}"
                     role="tabpanel" aria-labelledby="pills-{{ $mainPermission->id }}-tab">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <table class="table-auto">
                            <thead>
                            <tr class="bg-red-200">
                                <th class="px-4 py-2">{{ __('admin.ModuleTitle') }}</th>
                                @if (in_array(0, $mainPermission->permissions_types))
                                    <th class="px-4 py-2">
                                        {{ __('admin.List') }}
                                    </th>
                                @endif
                                <!-- Add other th here -->
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($mainPermission->children))
                                @foreach ($mainPermission->children as $row)
                                    <tr>
                                        <td class="px-4 py-2">{{ __('admin.' . $row->title) }}</td>
                                        @if (!empty($mainPermission->permissions_types))
                                            @foreach ($mainPermission->permissions_types as $td)
                                                <td class="px-4 py-2">
                                                    @if (!empty($row->sub_permissions_arr[$td]))
                                                        <input type="checkbox"
                                                               value="{{ $row->sub_permissions_arr[$td] }}"
                                                               name="permissions[]"
                                                            {{ in_array($row->sub_permissions_arr[$td], old('permissions', $item->permissions_ids ?? [])) ? 'checked' : '' }} />
                                                    @endif
                                                </td>
                                            @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        @endif
    </div>
</div>
