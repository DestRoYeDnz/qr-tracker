<?php

namespace App\Tables;

use App\Models\Campaign as CampaignModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class Campaign extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return QueryBuilder::for(CampaignModel::class)
            ->where('user_id', auth()->id())
            ->defaultSort('name','status')
            ->allowedSorts('name', 'email', 'status','from','to')
            ->paginate()
            ->withQueryString();
    }


    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name', 'email', 'status','from','to'])
            ->defaultSort('name')
            ->column('name', sortable: true)
            ->column('from', sortable: true)
            ->column('to', sortable: true)
            ->column('status', sortable: true)
            ->column('actions', sortable: false)
            ->export(
                label: 'CSV export',
                filename: 'projects.csv',
                type: Excel::CSV
            )
            ->selectFilter(
                key: 'status',
                options: ['CREATED','ACTIVE','PAUSED','DISABLED'],
                label: 'Status',
                noFilterOption: true,
                noFilterOptionLabel: 'All'
            );
    }
}
