<?php

namespace App\Controllers\Dashboard\Table;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BookingModel;

class BookingController extends BaseController
{
    public function index()
    {
        $booking = new BookingModel();
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 10; 
        $currentPage = $this->request->getGet('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $data = [
            'bookings' => $booking->search($search, $perPage, $offset),
            'search' => $search,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $booking->getCount($search)
        ];
        return view('admin/booking/table',$data);
    }
}
