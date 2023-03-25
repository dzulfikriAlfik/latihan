import AsyncStorage from "@react-native-async-storage/async-storage"
import { ToastAndroid } from "react-native"
import Axios from "../../configs/axios/Axios.config"

const getOrders = async (date) => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/pos/orders",
            {
                params: date,
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`,
                    "Content-Type": "application/json",
                }
            }
        )

        return response.data
    } catch (error) {
        console.log(error)
        ToastAndroid.show("Failed when get data orders.", 1500)

        return []
    }
}

const storeOrder = async (data) => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.post(
            "/vendor/pos/place-order",
            data,
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                }
            }
        )

        if(response.data.status) {
            ToastAndroid.show("Success store data order.", 1500)
            return response.data.list_item
        } else {
            ToastAndroid.show(`${ response.data.product } stock less than qty checkout.`, 1500)
            return []
        }
    } catch (error) {
        console.log(error)
        ToastAndroid.show("Failed when store data order.", 1500)
        
        return false
    }
}

export default () => {
    return {
        getOrders,
        storeOrder
    }
}