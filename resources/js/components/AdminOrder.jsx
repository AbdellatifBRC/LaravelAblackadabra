import React from 'react';
import * as ReactDOM from 'react-dom/client';
import axios from 'axios';

const AdminOrders = () => {
    const [search,setSearch] = React.useState('');
    const [loading, setLoading] = React.useState(true);
    const [orders, setOrders] = React.useState([]);
    const [page, setPage] = React.useState(1);
    const {APP_HOST , APP_PORT} = require('../config')
    const formatter = Intl.NumberFormat('fr',{
        style:'currency',
        currency: 'DZD'
    });

    async  function fetchOrdersData(){
        try {
        const data = await axios.get(`/api/orders`);

            console.log(data)
            setOrders(data.data.orders.data)
        } catch (error) {
            console.log(error);
        }
        setLoading(false);
    }
    React.useEffect(()=>{
        fetchOrdersData();

    },[search,page]);

     function getCategoriesName(categories,category_id){
       const categoty =  categories.filter((cat)=>{
           return cat.id === category_id
        })
        if (! categoty[0]) {
            return 'No Category'
        }else{
            return categoty[0].name;
        }


    }

    function totalPrice(order){
      const orderItems =  order.order_items;
      console.log(orderItems)
      var totalOrderPrice = 0;
      orderItems.forEach(element => {
        totalOrderPrice = totalOrderPrice + (element['base_total']);
        return totalOrderPrice;
      });
     // const priceSum = orderItems.reduce((prev , cur) => prev + cur['base_total'], 0)
      console.log(totalOrderPrice)
      return totalOrderPrice;
    }
    function deleteOrder(order){
        var orderId = order.id;
        axios.post(`${APP_HOST}:${APP_PORT}/admin/orders/${order.id}/destroy`,{orderId}).then((res)=>{
           if (res.status == 500){
            console.log('didnt work')
           }
        })
        fetchOrdersData();
    }

  return (

        <div>
            <div className="card-header">
                <h3>product List
                    <a href={`${APP_HOST}:${APP_PORT}/admin/products/create`} className="btn btn-primary float-right">
                        Create
                    </a>
                </h3>
            </div>
            <div className="card-body">
                <div className="table-responsive ">
                    <table className="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Client Name</th>
                                <th>Address</th>
                                <th>Address 2</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {loading ? <tr><td colSpan={8}>Loading...</td></tr> :orders.map((order,index)=>{
                                return(
                                 <tr key={index}>
                                    <td>{ index + 1 }</td>
                                    <td>{order.fullname?  order.fullname : 'NAN' }</td>
                                    <td>{ order.address? order.address : 'No Address' }</td>
                                    <td>{ order.address2? order.address2 : 'No address 2'}</td>
                                    <td>{ order.phone? order.phone :'No Phone' }</td>
                                    <td>{ order.email? order.email: 'No Email' }</td>
                                    <td>{  formatter.format(order.grand_total) }</td>
                                    <td>
                                        <div className="btn-group">
                                            <a href={`${APP_HOST}:${APP_PORT}/admin/products/${order.id}/show`} className="btn btn-warning">
                                                <i className="fa fa-eye"></i>
                                            </a>
                                            <a href={`${APP_HOST}:${APP_PORT}/admin/products/${order.id}/edit`} className="btn btn-info">
                                                <i className="fa fa-pencil-alt"></i>
                                            </a>

                                                {/* @csrf
                                                @method('delete') */}
                                                <button onClick={()=>{ confirm('are you sure ?');deleteProduct(order)}} type="button" className="btn btn-danger"><i className="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                )
                            })}

                            {/* @endforeach */}
                        </tbody>
                    </table>
                    <div className='row'>
                            <div className='col-sm-12 col-md-5'></div>
                            <div className='col-sm-12 col-md-7'>
                                 <ul className="pagination justify-content-center">
                                    <li className="page-item disabled">
                                        <a className="page-link">Previous</a>
                                    </li>
                                    <li className="page-item"><a className="page-link" href="#">1</a></li>
                                    <li className="page-item"><a className="page-link" href="#">2</a></li>
                                    <li className="page-item"><a className="page-link" href="#">3</a></li>
                                    <li className="page-item">
                                        <a className="page-link" href="#">Next</a>
                                    </li>
                                 </ul>
                            </div>

                        </div>
            </div>
   </div>
   </div>

  )
}
export default AdminOrders;
if (document.getElementById("admin-order-root")) {
    const root = ReactDOM.createRoot(document.getElementById("admin-order-root"));
    root.render(<AdminOrders />)
}
