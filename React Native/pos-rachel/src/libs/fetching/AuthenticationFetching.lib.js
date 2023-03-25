import AsyncStorage from "@react-native-async-storage/async-storage"
import { ToastAndroid } from "react-native"
import Axios from "../../configs/axios/Axios.config"

const login = async (data) => {
    try {
        const response = await Axios.post(
            "/auth/vendor/login",
            JSON.stringify(data),
            {
                headers: {
                    "Content-Type": "application/json"
                }
            }
        )

        const profile = await Axios.get(
            "/vendor/profile",
            {
                headers: {
                    "Authorization": `Bearer ${ response.data.token }`
                }
            }
        )

        await AsyncStorage.setItem("token", JSON.stringify(response.data.token))
        await AsyncStorage.setItem("user", JSON.stringify({
            id: profile.data.id,
            name: `${ profile.data.f_name } ${ profile.data.l_name }`,
            avatar: profile.data.image || "https://images.unsplash.com/photo-1537151672256-6caf2e9f8c95?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTh8fGNhcnRvb25zfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60",
            email: profile.data.email,
            phone: profile.data.phone,
            stores: profile.data.stores.map(store => {
                return {
                    id_store: store.id,
                    name_store: store.name,
                    logo_store: store.logo,
                    address_store: store.address,
                    vendor_id: store.vendor_id,
                }
            })
        }))

        return {
            status: true,
            message: "Success login user.",
        }
    } catch (error) {
        console.log(error)

        return {
            status: false,
            message: "Login user failed."
        }
    }
}

const verify = async (token) => {
    try {
        const response = await Axios.get(
            "/vendor/profile",
            {
                headers: {
                    "Authorization": `Bearer ${ token }`
                }
            }
        )

        if(response.data.errors) {
            const check = await login()

            if(check.status) {
                return true
            } else {
                ToastAndroid.show("Failed verification user.", 1500)

                await AsyncStorage.clear()

                return false
            }
        } else {
            return true
        }
    } catch (error) {
        ToastAndroid.show("Failed verification user.", 1500)

        await AsyncStorage.clear()

        return false
    }
}

export default () => {
    return {
        login,
        verify
    }
}