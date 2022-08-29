import AsyncStorage from "@react-native-async-storage/async-storage"
import { ToastAndroid } from "react-native"
import Axios from "../../configs/axios/Axios.config"

const monthlyReport = async () => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/pos/sales-monthlygroup",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                }
            }
        )

        return response.data
    } catch (error) {
        ToastAndroid.show("Failed get data monthly report.", 1500)
        
        return []
    }
}

const detailMonthlyReport = async (date) => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/pos/monthly-sales",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                },
                params: {
                    date
                }
            }
        )

        return response.data
    } catch (error) {
        ToastAndroid.show("Failed get data monthly report.", 1500)
        
        return []
    }
}

const dailyReport = async () => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/pos/sales-dailygroup",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                }
            }
        )

        return response.data
    } catch (error) {
        ToastAndroid.show("Failed get data daily report.", 1500)

        return []
    }
}

const detailDailyReport = async (date) => {
    try {
        const token = await AsyncStorage.getItem("token")

        const response = await Axios.get(
            "/vendor/pos/daily-sales",
            {
                headers: {
                    "Authorization": `Bearer ${ JSON.parse(token) }`
                },
                params: {
                    date
                }
            }
        )

        return response.data
    } catch (error) {
        ToastAndroid.show("Failed get data daily report.", 1500)

        return []
    }
}

export default () => {
    return {
        dailyReport,
        monthlyReport,
        detailMonthlyReport,
        detailDailyReport
    }
}