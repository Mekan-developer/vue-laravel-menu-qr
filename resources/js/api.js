import axios from "axios";
import router from "./router"

const api = axios.create()
// start request
api.interceptors.request.use(config =>{
    if(localStorage.getItem('access_token')){
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
    }                
    return config;
}, error => {
    console.log(error.response)
});
// end request
// start response
api.interceptors.response.use({}, error => {
    if(error.response.data.message === 'Token has expired'){
        return axios.post('/api/auth/refresh',{},{
            headers:{
                'Authorization' : `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then(res => {
            localStorage.setItem('access_token',res.data.access_token);
            error.config.headers.authorization = `Bearer ${res.data.access_token}`
            return api.request(error.config)
        }).catch(err => {
            console.log('error here', err)
        })
    }else if(error.response.status === 401)
        router.push({name: 'user.login'})
        
})
// end response
export default api