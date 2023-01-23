import axios from 'axios';
import { stringify } from 'postcss';
import React from 'react'
import * as ReactDOM  from 'react-dom/client';

export default function AdminUtilities() {
    const {APP_HOST,APP_PORT,APP_LOCK} = require('../config');
    const [utilities, setUtilities] = React.useState({
        phones: [],
        emails: [],
        logo: '',
        banner1: '',
        banner2: '',
        banner3: ''
    });
    const [loading, setLoading] = React.useState(true);
    const [error, setError] = React.useState('')
    const [data, setData] = React.useState({
        Phones: [],
        Emails: [],
        Logo: null,
        Banner1: null,
        Banner2: null,
        Banner3: null
    })
    const [editMod ,setEditMod] = React.useState({
        editPhones: false,
        editEmails: false,
        editLogo: false,
        editBanner1: false,
        editBanner2: false,
        editBanner3: false
    });

    function handelEmails(index,value){
        console.log((data.Emails[0][index]))
            data.Emails[0][index] = value
        console.log(data.Emails[0],index)
    }
     function handelPhones(index,value){
        console.log(data.Phones)
            data.Phones[0][index] = value
        console.log(data.Phones[0],index)
    }

    async function submitData(dataName,dataValue,action){
        switch (dataName) {
        case "logo":
            const logoFile = new FormData();
            logoFile.append("logo", data.Logo);
            console.log(logoFile)
            axios.post(`/api/utilities/update`,logoFile).then(res=>{
            console.log(res);
        })
        getUtilitiesData();
            break;
        case "banner1":
            const banner1 = new FormData();
            banner1.append("banner1", data.Banner1);
            console.log(banner1)
            axios.post(`/api/utilities/update`,banner1).then(res=>{
            console.log(res);
            })
            getUtilitiesData();
            break;
        case "banner2":
            const banner2 = new FormData();
            banner2.append("banner2", data.Banner2);
            console.log(banner2)
            axios.post(`/api/utilities/update`,banner2).then(res=>{
            console.log(res);
            })
            getUtilitiesData();
             break;
        case "banner3":
            const banner3 = new FormData();
            banner3.append("banner3", data.Banner3);
            console.log(banner3)
            axios.post(`/api/utilities/update`,banner3).then(res=>{
            console.log(res);
            })
            getUtilitiesData();
            break;
            default:
            try {
                if (action == "delete") {
                    console.log({[dataName]:dataValue, action:action})
                    var items = utilities[dataName].filter((data,index)=>{
                        return index !== dataValue
                    });

                    const Data = await axios.post(`/api/utilities/update`,{ [dataName]: items});
                    console.log(items)
                    getUtilitiesData();

                }else{
                     console.log({[dataName]:dataValue})
                     const Data = await axios.post(`/api/utilities/update`,{ [dataName]: dataValue});
                    getUtilitiesData();
                    console.log(Data)
                }

            } catch (error) {
                console.log(error)
            }
            break;
        }


    }

    async function getUtilitiesData(){
        console.log(`/api/utilities`)
        const Data = await axios.get(`/api/utilities`);
        //const phones = data.data.data.phones
        if (Data.data.data) {
             console.log(Data.data.data);
            setUtilities(Data.data.data);
        }

        if (Data.data.data) {
            if (Data.data.data.emails ||Data.data.data.phones) {
            setData({...data,
            Emails:[Data.data.data.emails],
            Phones:[Data.data.data.phones]
        })
        }

        }

        //setData({...data,Phones:[Object.values(Data.data.data.phones)]})
        console.log(data);
        setLoading(false)
    }
    React.useEffect(()=>{
        getUtilitiesData();

    },[])
    function displayEmails(){
        if (editMod.editEmails) {
            if (!utilities.emails) {
                return (<div>
                    <div className='d-flex justify-content-around align-middle'>
                       <div className='w-75'><input className='form-control' type="text" name='email' placeholder='New Emails' onChange={(e)=>{e.preventDefault();setData({Emails:[e.target.value]});}}/></div>
                       <div className='btn btn-success btn-circle btn-sm' onClick={(e)=>{e.preventDefault();submitData("emails",data.Emails)}}><i className="fas fa-check"></i></div>
                       <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editEmails:false})}}><i className="fas fa-window-close"></i></div>
                    </div>
                    <strong>no emails</strong>
                    </div>
                )
            }else{
                return(
                    <div>
                    <div className='d-flex justify-content-around align-middle'>
                       <div className='w-75'><input className='form-control' type="text" name='email' placeholder='New Emails' onChange={(e)=>{e.preventDefault();setData({Emails:[...utilities.emails,e.target.value]});}}/></div>
                       <div className='btn btn-success btn-circle btn-sm' onClick={(e)=>{e.preventDefault();submitData("emails",data.Emails)}}><i className="fas fa-check"></i></div>
                       <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editEmails:false})}}><i className="fas fa-window-close"></i></div>
                    </div>
                 {utilities.emails.map((email,idx)=>{
                return(
                    <div key={idx} className={"d-flex align-middle py-2 justify-content-between"}>
                        <div className='d-flex justify-content-between'>
                            <div>
                               <input className='form-control' type="text"  placeholder={email} onChange={(e)=>{e.preventDefault();handelEmails(idx,e.target.value)}}/>
                            </div>

                            <div className='btn btn-circle btn-danger btn-sm' onClick={(e)=>{e.preventDefault();submitData("emails",idx,"delete")}}>
                                <i className="fas fa-trash"></i>
                            </div>
                        </div>

                    <br></br>
                    </div>

                )
            })}
            <div className='d-flex justify-content-end'>
                <div className='btn btn-success btn-sm' onClick={(e)=>{e.preventDefault();submitData("emails",data.Emails[0])}}><i className="fas fa-check"></i>  Save</div>
            </div>
            </div>)}
        }else{
        if (!utilities.emails) {
            return (
                <div className='d-flex justify-content-between'>
                    <div><strong>no emails</strong></div>
                    <div className='btn btn-circle btn-primary btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editEmails:true})}}>
                        <i className="fas fa-plus"></i>
                    </div>
                </div>
            )
        }else{
            return(
                <>
                <div className='d-flex justify-content-center '>
                    <div className='btn btn btn-primary w-100 my-1' onClick={(e)=>{e.preventDefault();setEditMod({editEmails:true})}}>
                        <i className="fas fa-plus"></i> Add New Email
                    </div>
                </div>
            {utilities.emails.map((email,idx)=>{
            return(
                <div key={idx}>
                    <div className='d-flex justify-content-between'>
                        <div><strong >{email}</strong>
                        </div>
                        <div className='btn btn-circle btn-primary btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editEmails:true})}}>
                            <i className="fas fa-edit"></i>
                        </div>
                    </div>

                <br></br>
                </div>

            )
        })}
       </> )}
    }
    }

    function DisplayPhones(){
        if (editMod.editPhones) {
            if (!utilities.phones ) {
                return (<div>
                    <div className='d-flex justify-content-around align-middle'>
                       <div className='w-75'><input className='form-control' type="text" placeholder='New phones' onChange={(e)=>{e.preventDefault();setData({Phones:[e.target.value]});}}/></div>
                       <div className='btn btn-success btn-circle btn-sm' onClick={(e)=>{e.preventDefault();submitData("phones",data.Phones)}}><i className="fas fa-check"></i></div>
                       <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editPhones:false})}}><i className="fas fa-window-close"></i></div>
                    </div>
                    <strong>no Phones</strong>
                    </div>
                )
            }else{
                return(
                    <div>
                    <div className='d-flex justify-content-around align-middle'>
                       <div className='w-75'><input className='form-control' type="text"  placeholder='New Phones' onChange={(e)=>{setData({Phones:[...utilities.phones,e.target.value]});}}/></div>
                       <div className='btn btn-success btn-circle btn-sm' onClick={(e)=>{e.preventDefault();submitData("phones",data.Phones)}}><i className="fas fa-check"></i></div>
                       <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editPhones:false})}}><i className="fas fa-window-close"></i></div>
                    </div>
                 {utilities.phones.map((phone,idx)=>{
                return(
                    <div key={idx} className={"d-flex align-middle py-2 justify-content-between"}>
                        <div className='d-flex justify-content-between'>
                            <div>
                               <input className='form-control' type="text"  placeholder={phone} onChange={(e)=>{e.preventDefault();handelPhones(idx,e.target.value)}}/>
                            </div>

                            <div className='btn btn-circle btn-danger btn-sm' onClick={(e)=>{e.preventDefault();submitData("phones",idx,"delete")}}>
                                <i className="fas fa-trash"></i>
                            </div>
                        </div>

                    <br></br>
                    </div>

                )
            })}
            <div className='d-flex justify-content-end'>
                <div className='btn btn-success btn-sm' onClick={(e)=>{e.preventDefault();submitData("phones",data.Phones[0])}}><i className="fas fa-check"></i>  Save</div>
            </div>
            </div>)}
        }else{
        if (!utilities.phones ) {
            return (
                <div className='d-flex justify-content-between'>
                    <div><strong>no phones</strong></div>
                    <div className='btn btn-circle btn-primary btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editPhones:true})}}>
                        <i className="fas fa-plus"></i>
                    </div>
                </div>
            )
        }else{
            return(
                <>
                <div className='d-flex justify-content-between'>
                    <div className='btn btn btn-primary w-100 my-1' onClick={(e)=>{e.preventDefault();setEditMod({editPhones:true})}}>
                        <i className="fas fa-plus"></i> Add New Phones
                    </div>
                </div>
            {utilities.phones.map((phone,idx)=>{
            return(
                <div key={idx}>
                    <div className='d-flex justify-content-between'>
                        <div><strong >{phone}</strong>
                        </div>
                        <div className='btn btn-circle btn-primary btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({editPhones:true})}}>
                            <i className="fas fa-edit"></i>
                        </div>
                    </div>

                <br></br>
                </div>

            )
        })}
       </> )}
    }

    }
  return (
    <div className="col-xl col-md mb-4 ">
            <div className="card border-left-primary shadow h-100 ">
                                            {/* <!-- Card Header - Dropdown --> */}
                                            <div
                                            className="card-header py-3 d-flex flex-row align-items-center justify-content-between ">
                                            <h6 className="m-0 font-weight-bold text-primary">Dropdown Card Example</h6>
                                            <div className="dropdown no-arrow">
                                                <a className="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i className="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div className="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <div className="dropdown-header">Dropdown Header:</div>
                                                    <a className="dropdown-item" href="#">Action</a>
                                                    <a className="dropdown-item" href="#">Another action</a>
                                                    <div className="dropdown-divider"></div>
                                                    <a className="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                <div className="card-body">
                    <div className="row no-gutters ">
                        {/*  @foreach ($utilities as $utilitie)  */}
                            <div className="col-xl-4 col-md-6 mb-4 px-2">
                                {/* <!-- Collapsable Card Example --> */}
                                    <div className="card shadow mb-4">
                                        {/* <!-- Card Header - Accordion --> */}
                                        <a href="#emailCollapse" className="d-block card-header py-3" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 className="m-0 font-weight-bold text-primary">Email</h6>
                                         </a>
                                    {/* <!-- Card Content - Collapse --> */}
                                    <div className="collapse show" id="emailCollapse">
                                    <div className="card-body">
                                        {loading? <h1>Loading ...</h1> : displayEmails()}
                                    </div>
                                 </div>
                             </div>
                        </div>
                        {/* {{-- @endforeach --}}
                        {{-- email section --}} */}
                        {/* phone section start */}
                         <div className="col-xl-4 col-md-6 mb-4 px-2">
                                {/* <!-- Collapsable Card Example --> */}
                                    <div className="card shadow mb-4">
                                        {/* <!-- Card Header - Accordion --> */}
                                        <a href="#phonesCollapse" className="d-block card-header py-3" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 className="m-0 font-weight-bold text-primary">Phones</h6>
                                         </a>
                                    {/* <!-- Card Content - Collapse --> */}
                                    <div className="collapse show" id="phonesCollapse">
                                    <div className="card-body">
                                    {loading? <h1>Loading ...</h1> : DisplayPhones()}
                                    </div>
                                 </div>
                             </div>
                        </div>
                        {/* {{-- @endforeach --}}
                        {{-- phones section --}} */}
                         {/* logo section start */}
                         <div className="col-xl-4 col-md-6 mb-4 px-2">
                                {/* <!-- Collapsable Card Example --> */}
                                    <div className="card shadow mb-4">
                                        {/* <!-- Card Header - Accordion --> */}
                                        <a href="#logoCollapse" className="d-block card-header py-3" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 className="m-0 font-weight-bold text-primary">Logo</h6>
                                         </a>
                                    {/* <!-- Card Content - Collapse --> */}
                                    <div className="collapse show" id="logoCollapse">
                                    <div className="card-body">
                                    {editMod.editLogo==true?
                                    // logo input form
                                    <div className='d-flex justify-content-between'>
                                    <div><input className='w-75' type="file" onChange={(e)=>{e.preventDefault();setData({Logo:e.target.files[0]})}}/></div>
                                    <div className='d-flex'><div className="btn btn-circle btn-success btn-sm" onClick={(e)=>{e.preventDefault();submitData("logo",data.Logo)}}>
                                    <i className="fas fa-check"></i>
                                        </div>
                                        <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editLogo:false})}}><i className="fas fa-window-close"></i></div></div></div>:
                                    //loading logo data
                                    loading? <h1>Loading ...</h1> :utilities.logo == undefined?
                                     <div className='d-flex justify-content-between'>
                                        <div><strong>No image Loaded</strong></div>
                                     <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editLogo:true})}}><i className="far fa-edit"></i></a></div></div>:
                                     <div className='d-flex justify-content-between'>
                                        <div><img src={`/${utilities.logo} `} alt="" width={"50%"}/></div>
                                     <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editLogo:true})}}><i className="far fa-edit"></i></a></div></div>
                                     }
                                    </div>
                                 </div>
                             </div>
                        </div>
                        {/* {{-- @endforeach --}}
                        {{-- phones section --}} */}
                    </div>
                    <div className="row no-gutters ">
                        {/* seconde row  */}
                                {/* banner 1 section start */}
                            <div className="col-xl-4 col-md-6 mb-4 px-2">
                                {/* <!-- Collapsable Card Example --> */}
                                    <div className="card shadow mb-4">
                                        {/* <!-- Card Header - Accordion --> */}
                                        <a href="#banner1Collapse" className="d-block card-header py-3" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 className="m-0 font-weight-bold text-primary">Banner 1</h6>
                                         </a>
                                    {/* <!-- Card Content - Collapse --> */}
                                    <div className="collapse show" id="banner1Collapse">
                                    <div className="card-body">
                                    {editMod.editBanner1 ==true?
                                    // banner1 input form
                                    <div className='d-flex justify-content-between'>
                                    <div><input className='w-75' type="file" onChange={(e)=>{e.preventDefault();setData({Banner1:e.target.files[0]})}}/></div>
                                    <div className='d-flex'><div className="btn btn-circle btn-success btn-sm" onClick={(e)=>{e.preventDefault();submitData("banner1",data.Banner1)}}>
                                    <i className="fas fa-check"></i>
                                        </div>
                                        <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner1:false})}}><i className="fas fa-window-close"></i></div></div></div>

                                    :loading? <h1>Loading ...</h1> :
                                    utilities.banner1 == undefined?
                                    <div className='d-flex justify-content-between'>
                                        <div><strong>No image Loaded</strong></div>
                                        <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner1:true})}}><i className="far fa-edit"></i></a></div></div>:
                                        <div className='d-flex justify-content-between'>
                                        <div><img src={`/${utilities.banner1} `} alt="" width={"50%"}/></div>
                                        <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner1:true})}}><i className="far fa-edit"></i></a></div></div>
                                        }
                                    </div>
                                 </div>
                             </div>
                        </div>
                        {/* {{-- @endforeach --}}
                        {{-- banner 1 section --}} */}
                         {/* banner2  section start */}
                         <div className="col-xl-4 col-md-6 mb-4 px-2">
                                {/* <!-- Collapsable Card Example --> */}
                                    <div className="card shadow mb-4">
                                        {/* <!-- Card Header - Accordion --> */}
                                        <a href="#banner2Collapse" className="d-block card-header py-3" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 className="m-0 font-weight-bold text-primary">Banner 2</h6>
                                         </a>
                                    {/* <!-- Card Content - Collapse --> */}
                                    <div className="collapse show" id="banner2Collapse">
                                    <div className="card-body">
                                    {editMod.editBanner2 ==true?
                                    // logo input form
                                    <div className='d-flex justify-content-between'>
                                    <div><input className='w-75' type="file" onChange={(e)=>{e.preventDefault();setData({Banner2:e.target.files[0]})}}/></div>
                                    <div className='d-flex'><div className="btn btn-circle btn-success btn-sm" onClick={(e)=>{e.preventDefault();submitData("banner2",data.Banner2)}}>
                                    <i className="fas fa-check"></i>
                                        </div>
                                        <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner2:false})}}><i className="fas fa-window-close"></i></div></div></div>
                                    :loading? <h1>Loading ...</h1> :
                                    utilities.banner2 == undefined?
                                    <div className='d-flex justify-content-between'>
                                        <div><strong>No image Loaded</strong></div>
                                        <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner2:true})}}><i className="far fa-edit"></i></a></div></div>:
                                        <div className='d-flex justify-content-between'>
                                        <div><img src={`/${utilities.banner2} `} alt="" width={"50%"}/></div>
                                        <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner2:true})}}><i className="far fa-edit"></i></a></div></div>
                                        }
                                    </div>
                                 </div>
                             </div>
                        </div>
                        {/* {{-- @endforeach --}}
                        {{-- banner2 section --}} */}
                         {/* banner3  section start */}
                         <div className="col-xl-4 col-md-6 mb-4 px-2">
                                {/* <!-- Collapsable Card Example --> */}
                                    <div className="card shadow mb-4">
                                        {/* <!-- Card Header - Accordion --> */}
                                        <a href="#banner3Collapse" className="d-block card-header py-3" data-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 className="m-0 font-weight-bold text-primary">Banner 3</h6>
                                         </a>
                                    {/* <!-- Card Content - Collapse --> */}
                                    <div className="collapse show" id="banner3Collapse">
                                    <div className="card-body">
                                    {editMod.editBanner3 ==true?
                                    // logo input form
                                    <div className='d-flex justify-content-between'>
                                    <div><input className='w-75' type="file" onChange={(e)=>{e.preventDefault();setData({Banner3:e.target.files[0]})}}/></div>
                                    <div className='d-flex'><div className="btn btn-circle btn-success btn-sm" onClick={(e)=>{e.preventDefault();submitData("banner3",data.Banner3)}}>
                                    <i className="fas fa-check"></i>
                                        </div>
                                        <div className='btn btn-danger btn-circle btn-sm' onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner3:false})}}><i className="fas fa-window-close"></i></div></div></div>
                                    :loading? <h1>Loading ...</h1> :
                                   utilities.banner3 == undefined?
                                   <div className='d-flex justify-content-between'>
                                        <div><strong>No image Loaded</strong></div>
                                        <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner3:true})}}><i className="far fa-edit"></i></a></div></div>:
                                   <div className='d-flex justify-content-between'>
                                   <div><img src={`/${utilities.banner3} `} alt="" width={"50%"}/></div>
                                   <div><a onClick={(e)=>{e.preventDefault();setEditMod({...editMod,editBanner3:true})}}><i className="far fa-edit"></i></a></div></div>
                                   }
                                    </div>
                                 </div>
                             </div>
                        </div>
                        {/* {{-- @endforeach --}}
                        {{-- banner3 section --}} */}
                    </div>
                </div>
            </div>
        </div>
  )
}
if (document.getElementById('utilities-root')) {
    const root = ReactDOM.createRoot(document.getElementById('utilities-root'));
    root.render(<AdminUtilities/>)
}
