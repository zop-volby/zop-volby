<div class="card">
    <h3 class="card-header">{{ __('Průběh voleb') }}</h3>
    <div class="card-body">
        <div>
            Celkem je <b>{{ $model->get_chart()->voters_count() }}</b> voličů.
        </div>
        <table width="100%">
            @for ($i = 1; $i < $model->get_chart()->get_size(); $i++)
                <tr>
                    <td class="pe-2" width="1px">{{ $model->get_chart()->get_value($i) }}</td>
                    <td>
                        <div class="text-bg-{{ $model->get_chart()->get_color($i) }} p-2" style="{{ $model->get_chart()->get_style($i) }}"></div>
                    </td>
                </tr>
            @endfor
        </table>
    </div>
    <div class="card-footer">
        <div class="d-flex gap-1">
            @for ($i = 1; $i < $model->get_chart()->get_size(); $i++)
                <div class="text-bg-{{ $model->get_chart()->get_color($i) }} p-1 flex-fill text-center">
                    {{ __('widget.results.' . $model->get_chart()->get_label($i)) }}
                </div>
            @endfor
        </div>
    </div>
</div>