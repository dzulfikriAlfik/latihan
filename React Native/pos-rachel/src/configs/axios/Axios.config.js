import axios from "axios"

const Axios = axios.create({ baseURL: "https://adm.wemart.id/api/v1" })

export default Axios