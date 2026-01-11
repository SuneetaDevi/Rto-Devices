<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display the main Report landing page.
     */
    public function index()
    {
        $title = "Reports";
        return view('tenant.report.index', compact('title'));
    }

    /**
     * Display the Portfolio Report.
     */
    public function portfolio()
    {
        return view('tenant.report.portfolio');
    }

    /**
     * Display the Sales Report.
     */
    public function sales()
    {
        return view('tenant.report.sales');
    }

    /**
     * Display the Payment Report.
     */
    public function payment()
    {
        return view('tenant.report.payment');
    }

    /**
     * Display the Dealer Contract Reconciliation Report.
     */
    public function dealerContractReconciliation()
    {
        return view('tenant.report.dealer_contract');
    }

    /**
     * Display the Detailed Portfolio Report.
     */
    public function detailedPortfolio()
    {
        return view('tenant.report.detailed_portfolio');
    }
}
