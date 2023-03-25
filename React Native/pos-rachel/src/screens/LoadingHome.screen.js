import React, { Fragment, useEffect, useState } from "react"
import { SafeAreaView, Text, View, Animated, Image, Dimensions, ToastAndroid } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import AsyncStorage from "@react-native-async-storage/async-storage"
import ProductFetching from "../libs/fetching/ProductFetching.lib"
import CategorieFetching from "../libs/fetching/CategorieFetching.lib"
import RNRestart from "react-native-restart"

const LoadingHome = ({ navigation, changeUser, changeProducts, changeCategories }) => {
    const translate = new Animated.Value(-400)
    const [widthScreen, setWidthScreen] = useState(Dimensions.get("screen").width)

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    useEffect(() => {
        async function initData() {
            try {
                const user = await AsyncStorage.getItem("user")
    
                changeUser(JSON.parse(user))
            } catch (error) {
                navigation.reset({ index: 0, routes: [{ name: "Splash" }] })
            }
        }

        initData()
    }, [])

    useEffect(() => {
        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })

        Animated.timing(translate, {
            toValue: 0,
            useNativeDriver: true,
            duration: 2500,
        }).start()
    }, [])

    useEffect(() => {
        async function initData() {
            let total_size = 0
            let promises = []
            let indexLoop = 0
            let isLoop = true

            try {
                total_size = await ProductFetching().getProductsSize()
            } catch (error) {
                ToastAndroid.show("Failed get data size products.", 1500)
                RNRestart.Restart()
            }

            while (isLoop) {
                indexLoop += 1

                if(200 * indexLoop >= total_size) {
                    isLoop = false
                    break
                }
            }

            if(total_size - (200 * (indexLoop - 1)) > 200) {

            } else {
                indexLoop += 1
            }

            for (let index = 1; index <= indexLoop - 1; index++) {
                promises.push(new Promise(async (resolve, reject) => {
                    try {
                        const response = await ProductFetching().getProducts({
                            limit: 200,
                            offset: index
                        })

                        let dataMap = response.map((itemProduct) => {

                            return {
                                id: itemProduct.id,
                                sku_id: itemProduct.sku_id,
                                name: itemProduct.name,
                                price: itemProduct.price,
                                stock: itemProduct.stock,
                                category_id: itemProduct.category_id,
                                module_id: itemProduct.module_id
                            }
                        })

                        let products = await AsyncStorage.getItem("products")
                        await AsyncStorage.setItem("products", JSON.stringify([...JSON.parse(products), ...dataMap]))

                        resolve(true)
                    } catch (error) {
                        reject(error.message)
                    }
                }))
            }

            Promise.all(promises)
                .then(async () => {
                    const products = await AsyncStorage.getItem("products")
                    const categories = await CategorieFetching().getCategories()

                    // if(JSON.parse(products).length < total_size) {
                    //     ToastAndroid.show("Failed get data products.", 1500)
                    //     RNRestart.Restart()
                    // }

                    changeCategories(categories)
                    changeProducts([...JSON.parse(products)])
                    navigation.replace("Home")
                }).catch(error => {
                    RNRestart.Restart()
                    AsyncStorage.setItem("products", JSON.stringify([]))
                })
        }

        initData()
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ Tailwind`w-full min-h-full flex-col items-center justify-center bg-primary--red p-10` }>
                    <Image
                        source={ require("../assets/images/logo-white.png") }
                        style={ Tailwind`w-40 h-40 mb-16` }
                        resizeMode={ "contain" }
                    />
                    <View style={ Tailwind`w-full flex flex-col items-center` }>
                        <View style={ Tailwind`${ handleResponsive(["w-full", "w-96"]) } h-2 rounded-full bg-white--30 mb-3 overflow-hidden` }>
                            <Animated.View style={ [Tailwind`w-full h-2 rounded-full bg-white`, { transform: [{ translateX: translate }] }] }/>
                        </View>
                        <Text style={ Tailwind`font-medium text-base text-white tracking-wide` }>
                            Sedang Menyiapkan Toko Kamu...
                        </Text>
                    </View>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeUser : (value) => dispatch({type: 'CHANGE_USER', newValue: value}),
        changeProducts: (value) => dispatch({ type: `CHANGE_PRODUCTS`, newValue: value }),
        changeCategories: (value) => dispatch({ type: `CHANGE_CATEGORIES`, newValue: value })
    }
}

export default connect(null, mapDispatchToProps)(LoadingHome)