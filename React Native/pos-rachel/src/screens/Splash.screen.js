import AsyncStorage from "@react-native-async-storage/async-storage"
import React, { Fragment, useEffect } from "react"
import { Image, LogBox, SafeAreaView, View } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import AuthenticationFetching from "../libs/fetching/AuthenticationFetching.lib"

const Splash = ({ navigation }) => {
    LogBox.ignoreAllLogs(true)

    useEffect(() => {
        async function initData() {
            AsyncStorage.setItem("products", JSON.stringify([]))

            const keys = await AsyncStorage.getAllKeys()

            if(!keys.includes("cart")) {
                AsyncStorage.setItem("cart", JSON.stringify([]))
            }
    
            if(!keys.includes("transactions")) {
                AsyncStorage.setItem("transactions", JSON.stringify([]))
            }
    
            try {
                const token = await AsyncStorage.getItem("token")
    
                if(token) {
                    const verification = await AuthenticationFetching().verify(JSON.parse(token))
    
                    if(verification) {
                        navigation.replace("LoadingHome")
                    } else {
                        navigation.replace("Boarding")
                    }
                } else {
                    await AsyncStorage.multiRemove(["token", "user"])
    
                    navigation.replace("Boarding")
                }
            } catch (error) {
                await AsyncStorage.multiRemove(["token", "user"])
    
                navigation.replace("Boarding")
            }
        }

        initData()
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ Tailwind`w-full min-h-full flex flex-col items-center justify-center bg-primary--red` }>
                    <Image
                        source={ require("../assets/images/logo-white.png") }
                        style={ Tailwind`w-50 h-50` }
                        resizeMode={ "contain" }
                    />
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default Splash