import axios from 'axios';
import React, { useCallback } from 'react';
import * as  ReactDOM  from 'react-dom/client';

export default function AdminMessages() {
    const [messages, setMessages] = React.useState([]);
    const [loading , setLoading] = React.useState(true);
    const [isSelected, setIsSelected] = React.useState([]);
    const {APP_HOST,APP_PORT} = require('../config');
    async function getMessages(){
        try {
            const msg = await axios.get(`/api/messages`);
            console.log(msg);
            setMessages(Object.values(msg.data.messages))
            setLoading(false)
        } catch (error) {
            console.log(error)
        }

    }

    const  handelSelection = (item)=>{
        const selectedItem =isSelected;

        if (selectedItem.includes(item) ) {
            const index = selectedItem.indexOf(item)
            selectedItem.splice(index,1)
            //setIsSelected(selectedItem);
            setIsSelected([...selectedItem]);
        } else {
            selectedItem.push(item)
            setIsSelected([...selectedItem])
        }

        console.log('lets see',isSelected)

    }
   async function handleAction(e,action){
        e.preventDefault();
        var ids = [];
        for (const index of isSelected) {
            ids.push(messages[index].id);
        }
        const res = await axios.post(`/api/messages/${action}`,{messages:ids})
        .then(res=>{
            console.log(res);
            getMessages();
            if (action == 'delete') {
                setIsSelected([])
            }
        })
    }

    React.useEffect(()=>{
        getMessages();
        //console.log(isSelected)
    },[])
  return (
    <div className="col-xl col-md mb-4 ">
    <div className="card border-left-primary shadow h-100 ">
        <h1 className="py-2 px-2">Messages</h1>
       {isSelected.length===0? null :<div className='d-flex justify-content-center align-baseline'>
        <div className='mx-3 py-1'><h6>selected: {isSelected.length}</h6></div>
        <div className='mx-3'  onClick={e=>{handleAction(e,'delete')}}>
            <a href="#" className="btn btn-danger btn-icon-split btn-sm">
                <span className="icon text-white-50">
                     <i className="fas fa-trash"></i>
                </span>
                <span className="text">Delete</span>
        </a></div>
        <div className='mx-3' onClick={e=>{handleAction(e,'seen')}}>
            <a href="#" className="btn btn-light btn-icon-split btn-sm">
                <span className="icon text-dark-50">
                     <i className="fas fa-envelope-open"></i>
                </span>
                <span className="text">Mark as Seen</span>
        </a></div>
        <div className='mx-3' onClick={e=>{handleAction(e,'unseen')}}>
            <a href="#" className="btn btn-light btn-icon-split btn-sm">
                <span className="icon text-dark-50">
                    <i className="fas fa-envelope"></i>
                </span>
                <span className="text">Mark as Unseen</span>
        </a></div>
        </div>}
        {loading?<span>Loading...</span>:
            messages.length === 0 ? <h2>no message</h2>:
           messages.map((message,idx)=>{
            if (message.status == 'unread') {
                return(
                <div key={idx} className="card border-left-primary shadow py-2 px-3 my-2 mx-3 d-flex">
                <div className="d-flex">
                <div className="col-2 d-flex">
                {isSelected.includes(idx) ?<div className='btn btn-light btn-circle' onClick={e=>{e.preventDefault();handelSelection(idx)}}><i className="far fa-check-square" ></i></div>: <div className='btn btn-light btn-circle' onClick={e=>{e.preventDefault();handelSelection(idx)}}><i className="far fa-square" ></i></div>}
                   </div>
                    <div className="col-2">
                     <span><strong>{message.name}</strong></span>
                </div>
                <div className="col-4">
                    <span className=""><strong>{message.email}</strong></span>
               </div>
               <div className="col-4">
                <span><strong>{message.text.substring(0,10)}...</strong></span>
                </div>
                    </div>
                </div>
                )
            }
            else{
                return(
                <div key={idx} className="card border-left-primary shadow py-2 px-3 my-2 mx-3 d-flex">
                <div className="d-flex">
                    <div className="col-2 d-flex">
                    {isSelected.includes(idx) ?<div className='btn btn-light btn-circle' onClick={e=>{e.preventDefault();handelSelection(idx)}}><i className="far fa-check-square" ></i></div>: <div className='btn btn-light btn-circle' onClick={e=>{e.preventDefault();handelSelection(idx)}}><i className="far fa-square" ></i></div>}
                   </div>
                    <div className="col-2">
                     <span>{message.name}</span>
                </div>
                <div className="col-4">
                    <span className="">{message.email}</span>
               </div>
               <div className="col-4">
                <span>{message.text.substring(0,10)}...</span>
           </div>
                </div>

            </div>
                )
            }
  }
      )
}
</div>
    </div>
)
}

if (document.getElementById('message_root')) {
    const root = ReactDOM.createRoot(document.getElementById('message_root'))
    root.render(<AdminMessages/>)
}
