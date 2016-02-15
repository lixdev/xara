<?php

class ErpReportsController extends \BaseController {


	public function clients(){

		$clients = Client::all();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('erpreports.clientsReport', compact('clients', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Client List.pdf');
		
	}

    public function items(){

        $items = Item::all();

        $organization = Organization::find(1);

        $pdf = PDF::loadView('erpreports.itemsReport', compact('items', 'organization'))->setPaper('a4')->setOrientation('potrait');
    
        return $pdf->stream('Item List.pdf');
        
    }

    public function expenses(){

        $expenses = Expense::all();

        $organization = Organization::find(1);

        $pdf = PDF::loadView('erpreports.expensesReport', compact('expenses', 'organization'))->setPaper('a4')->setOrientation('potrait');
    
        return $pdf->stream('Expense List.pdf');
        
    }

    public function paymentmethods(){

        $paymentmethods = Paymentmethod::all();

        $organization = Organization::find(1);

        $pdf = PDF::loadView('erpreports.paymentmethodsReport', compact('paymentmethods', 'organization'))->setPaper('a4')->setOrientation('potrait');
    
        return $pdf->stream('Payment Method List.pdf');
        
    }

    public function payments(){

        $payments = Payment::all();

        $erporders = Erporder::all();

        $erporderitems = Erporderitem::all();

        $organization = Organization::find(1);

        $pdf = PDF::loadView('erpreports.paymentsReport', compact('payments','erporders', 'erporderitems', 'organization'))->setPaper('a4')->setOrientation('potrait');
    
        return $pdf->stream('Payment List.pdf');
        
    }




    public function locations(){

        $locations = Location::all();


        $organization = Organization::find(1);

        $pdf = PDF::loadView('erpreports.locationsReport', compact('locations', 'organization'))->setPaper('a4')->setOrientation('potrait');
    
        return $pdf->stream('Stores List.pdf');
        
    }



    public function stock(){

        $items = Item::all();


        $organization = Organization::find(1);

        $pdf = PDF::loadView('erpreports.stockReport', compact('items', 'organization'))->setPaper('a4')->setOrientation('potrait');
    
        return $pdf->stream('Stock Report.pdf');
        
    }

}
