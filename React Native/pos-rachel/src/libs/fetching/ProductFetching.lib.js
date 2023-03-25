import { ToastAndroid } from "react-native"
import Axios from "../../configs/axios/Axios.config"
import AsyncStorage from "@react-native-async-storage/async-storage"

const getProducts = async (params) => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/get-items-list",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                },
                params
            }
        )

        return response.data.items
    } catch (error) {
        console.log(error)
        return []
    }
}

const getProductsSize = async () => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/get-items-list",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                },
                params: {
                    limit: 1,
                    offset: 1
                }
            }
        )

        return response.data.total_size
    } catch (error) {
        console.log(error)
        return []
    }
}

export default () => {
    return {
        getProducts,
        getProductsSize
    }
}