import React, { Fragment, useState } from "react"
import { ActivityIndicator, SafeAreaView, ToastAndroid, ImageBackground, View } from "react-native"
import { RNCamera } from "react-native-camera"
import QRCodeScanner from "react-native-qrcode-scanner"
import { connect } from "react-redux"
import Tailwind from "../libs/tailwind/Tailwind.lib"

const ScanQr = ({ navigation, cart, changeCart, products, transactions }) => {
    const [isLoading, setIsLoading] = useState(false)

    const readQr = (qr) => {
        try {
            setIsLoading(true)

            let item = null
            const data = [...cart]
            let stockRemain = 0

            products.forEach(product => {
                if(product.sku_id == qr.data) {
                    item = product
                }
            })

            if(qr.data && item) {
                transactions.forEach(transaction => {
                    transaction.data.forEach(itemProduct => {
                        if(itemProduct.id === item.id) {
                            stockRemain += itemProduct.qty
                        }
                    })
                })
                
                if(item.stock && stockRemain < item.stock) {
                    if(data.length) {
                        let exist = false
        
                        const result = data.map(cartItem => {
                            if(cartItem.id === item.id) {
                                exist = true
        
                                if(cartItem.qty >= item.stock) {
                                    ToastAndroid.show("All stock product already in cart", 1500)
        
                                    return { ...cartItem }
                                } else {
                                    if(stockRemain) {
                                        if(cartItem.qty >= (item.stock - stockRemain)) {
                                            ToastAndroid.show("All stock product already in cart", 1500)
            
                                            return { ...cartItem }
                                        } else {
                                            return { ...cartItem, qty: cartItem.qty + 1 }
                                        }
                                    } else {
                                        return { ...cartItem, qty: cartItem.qty + 1 }
                                    }
                                }
                            } else {
                                return cartItem
                            }
                        })
        
                        if(!exist) return changeCart([...cart, { ...item, qty: 1 }])
        
                        changeCart([...result])
                        ToastAndroid.show("Product added to cart.", 1500)
                    } else {
                        changeCart([...cart, { ...item, qty: 1 }])
                        ToastAndroid.show("Product added to cart.", 1500)
                    }
                } else {
                    ToastAndroid.show("Stock product is empty", 1500)
                }
            } else {
                ToastAndroid.show("Product not found.", 1500)
            }

            const timeout = setTimeout(() => {
                setIsLoading(false)
                clearTimeout(timeout)
            }, 2000);
        } catch (error) {
            ToastAndroid.show("Failed scan barcode.", 1500)
            setIsLoading(false)
        }
    }

    return (
        <Fragment>
            <SafeAreaView>
                <QRCodeScanner
                    onRead={ (e) => readQr(e) }
                    customMarker={ 
                        isLoading ? 
                            <ActivityIndicator size={ "large" } color={ "#FFFFFF" }/> :
                            <ImageBackground 
                                source={ require("../assets/images/scan.png") }
                                resizeMode={ "contain" }
                                style={ Tailwind`w-full min-h-full flex flex-row items-center justify-center` }
                            >
                                <View style={ Tailwind`w-70 h-23 border-2 border-white mt-1` }/>
                            </ImageBackground> 
                    }
                    containerStyle={ Tailwind`flex flex-row items-center justify-center w-full min-h-full` }
                    flashMode={ RNCamera.Constants.FlashMode.off }
                    vibrate={ true }
                    showMarker={ true }
                    cameraType={ "back" }
                    reactivate={ true }
                    reactivateTimeout={ 2000 }
                />
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        cart : state.cart,
        products: state.products,
        transactions: state.transactions
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCart : (value) => dispatch({type: 'CHANGE_CART', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ScanQr)