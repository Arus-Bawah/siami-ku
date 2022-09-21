<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\MasterUnitTipeModel;
use App\TemplatesModel;

class AuditTemplateController extends Controller
{
    public function index()
    {
        // get query
        $query = request()->query();
        $page = request()->get('page') == '' ? 1 : (int)request()->get('page');
        $limit = request()->get('limit') == '' ? 20 : (int)request()->get('limit');
        $search = request()->get('search') == '' ? '' : request()->get('search');
        $filter = is_array(request()->get('filter')) ? request()->get('filter') : [];

        // get data
        $data = TemplatesModel::with(['tipe', 'unit', 'jenjang'])
            ->where(function ($q) use ($search) {
                if ($search) {
                    $q->where('templates.name', 'LIKE', '%' . $search . '%');
                    $q->orWhereHas('tipe', function ($qry) use ($search) {
                        $qry->where('tipe', 'LIKE', '%' . $search . '%');
                    });
                    $q->orWhereHas('unit', function ($qry) use ($search) {
                        $qry->where('unit', 'LIKE', '%' . $search . '%');
                    });
                    $q->orWhereHas('jenjang', function ($qry) use ($search) {
                        $qry->where('jenjang', 'LIKE', '%' . $search . '%');
                    });
                }
            })
            ->orderBy('id', 'DESC')
            ->paginate($limit);

        # set pagination
        $start = ($page * $limit) - $limit;
        $start = ($page > 1 ? $start + 1 : 1);
        $end = $start + $limit - 1;
        $end = ($end < $data->total() ? $end : $data->total());

        return view('cms.page.audit-template.index', [
            'data' => $data,
            'query' => $query,
            'limit' => $limit,
            'search' => $search,
            'filter' => $filter,
            'entries' => [
                'start' => $start,
                'end' => $end,
                'total' => $data->total(),
            ],
        ]);
    }

    public function add()
    {
        $unit = MasterUnitTipeModel::with('unit.jenjang.jenjang')
            ->get();

        return view('cms.page.audit-template.add', [
            'unit' => $unit,
        ]);
    }

    public function save()
    {
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}
