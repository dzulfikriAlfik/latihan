import AsyncStorage from "@react-native-async-storage/async-storage"
import Axios from "../../configs/axios/Axios.config"
import { ToastAndroid } from "react-native"

const getCategories = async () => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/categories",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                }
            }
        )
        
        return response.data
    } catch (error) {
        ToastAndroid.show("Failed when get data categories.", 1500)

        return []
    }
}

export default () => {
    return {
        getCategories
    }
}