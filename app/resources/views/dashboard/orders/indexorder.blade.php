@include('layout_dashboard_start')
<!-- Main content goes here -->

<div class="dashboardContent">
    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
            <tr>
    <th>Order Id @sortablelink('fname','↑↓')</th>
    <th>Quantity @sortablelink('email','↑↓')</th>
    <th>Product Name @sortablelink('role','↑↓')</th>
    <th>Product Price @sortablelink('country','↑↓')</th>
    <th>Total Price @sortablelink('city','↑↓')</th>
    <th>Buyer Name  @sortablelink('lname','↑↓')</th>
    <th>Comments @sortablelink('photo','↑↓')</th>
</tr>
</thead>
<tbody id="">
<tr>
    <td>1</td>
    <td>2</td>
    <td>Watch</td>
    <td>1299</td>
    <td>1799</td>
    <td>Ahmed</td>
    <td>Good Product</td>
    
</tr>
<tr>
    <td>4</td>
    <td>2</td>
    <td>Comb</td>
    <td>1100</td>
    <td>1499</td>
    <td>Ali</td>
    <td>Good Product</td>
    
</tr>
<tr>
    <td>5</td>
    <td>3</td>
    <td>Wire</td>
    <td>1299</td>
    <td>1799</td>
    <td>Alia</td>
    <td>Copper Wire</td>
    
</tr>
<tr>
    <td>1</td>
    <td>2</td>
    <td>Watch</td>
    <td>1299</td>
    <td>1799</td>
    <td>Ahmed</td>
    <td>Good Product</td>
    
</tr>
<tr>
    <td>1</td>
    <td>2</td>
    <td>Watch</td>
    <td>1299</td>
    <td>1799</td>
    <td>Ahmed</td>
    <td>Good Product</td>
    
</tr>

</tbody>

        </table>
        </div>
</div>
    </div>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

@include('layout_dashboard_end')