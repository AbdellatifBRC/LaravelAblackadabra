import React from 'react';
import * as ReactDOM from 'react-dom/client';
import axios from 'axios';

const AdminProducts = () => {
    const [search,setSearch] = React.useState('');
    const [loading, setLoading] = React.useState(true);
    const [products, setProducts] = React.useState([]);
    const [categories, setCategories] = React.useState([]);
    const [page, setPage] = React.useState(1);
    const {APP_HOST , APP_PORT} = require('../config')
    const formatter = Intl.NumberFormat('fr',{
        style:'currency',
        currency: 'DZD'
    });
    async  function fetchCategoriesData(){
        try {
        const data = await axios.get(`/api/categories`);

           // console.log('cat',data.data.data)
            setCategories(data.data.data)
        } catch (error) {
            console.log(error);
        }
    }
    async  function fetchTagsData(){
        try {
        const data = await axios.get(`/api/tags`);

            console.log('tags',data)
            //setCategories(data.data.data)
        } catch (error) {
            console.log(error);
        }
    }
    async  function fetchProductsData(){
        try {
        const data = await axios.get(`/api/products`);

            //console.log(data)
            setProducts(data.data.data.products.data)
        } catch (error) {
            console.log(error);
        }
        setLoading(false);
    }
    React.useEffect(()=>{
        fetchCategoriesData();
        //fetchTagsData();
        fetchProductsData();

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

    function showImages(product){
        if (product.gallery.length > 0) {
            return(
              <a href={product.gallery[0].original_url} target="_blank">
                 <img src={product.gallery[0].original_url} width="45px" height="45px" alt=""/>
             </a>
            )
         }else{
            return(
                  <span className="badge badge-warning">no image</span>
            );
         }
    }
    function deleteProduct(product){
        var productId = product.id;
        axios.post(`products/${product.id}/destroy`,{productId}).then((res)=>{
           if (res.status == 500){
            console.log('didnt work')
           }
        })
        fetchProductsData();
    }

  return (

        <div>
            <div className="card-header">
                <h3>product List
                    <a href={`products/create`} className="btn btn-primary float-right">
                        Create
                    </a>
                </h3>
            </div>
            <div className="card-body">
                <div className="table-responsive overflow-hidden">
                    <table className="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {loading ? <tr><td colSpan={8}>Loading...</td></tr> :products.map((product,index)=>{
                                return(
                                 <tr key={index}>
                                    <td>{index + 1}</td>
                                    <td>{ product.name }</td>
                                    <td>
                                        <span className="badge badge-success">{getCategoriesName(categories,product.category_id) }</span>
                                    </td>
                                    <td>
                                        {product.tags.map((tag,idx)=>{
                                            return(
                                                 <span key={idx} className="badge badge-primary"> { tag.name  }</span>
                                            )
                                        })}
                                    </td>
                                    <td>{ formatter.format(product.price) }</td>
                                    <td>{ product.quantity }</td>
                                    <td>
                                        {showImages(product)}
                                    </td>
                                    <td>
                                        <div className="btn-group">
                                            <a href={`/admin/products/${product.id}`} className="btn btn-warning">
                                                <i className="fa fa-eye"></i>
                                            </a>
                                            <a href={`/admin/products/${product.id}/edit`} className="btn btn-info">
                                                <i className="fa fa-pencil-alt"></i>
                                            </a>

                                                {/* @csrf
                                                @method('delete') */}
                                                <button onClick={()=>{ confirm('are you sure ?');deleteProduct(product)}} type="button" className="btn btn-danger"><i className="fa fa-trash"></i></button>
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
                                 <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                 </ul>
                            </div>

                        </div>
            </div>
   </div>
   </div>
  )
}
export default AdminProducts;
if (document.getElementById("admin-product-root")) {
    const root = ReactDOM.createRoot(document.getElementById("admin-product-root"));
    root.render(<AdminProducts />)
}

// if(document.getElementById("admin-product-root")){
//     ReactDOM.render(<AdminProducts />,document.getElementById("admin-product-root"))
// }
