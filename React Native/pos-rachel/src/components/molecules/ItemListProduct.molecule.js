import React, { Fragment } from "react"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { ImageBackground, Text, ToastAndroid, TouchableHighlight, View } from "react-native"
import { connect } from "react-redux"

const ItemListProduct = ({ item, cart, changeCart, transactions, canAction, changeIdProductUpdate }) => {
    const handleChange = () => {
        const data = [...cart]
        let stockRemain = 0

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
            } else {
                changeCart([...cart, { ...item, qty: 1 }])
            }
        } else {
            ToastAndroid.show("Stock product is empty", 1500)
        }
    }

    const fixingNumberAmount = (value) => {
        const splitValue = value.split(",")[value.split(",").length - 1].split("").slice(1, 3).join("")
        let result = ""
        let arrResult = value.split(",")

        if(parseInt(splitValue) > 0 && parseInt(splitValue) <= 99) {
            result = `${ parseInt(value.split(",")[value.split(",").length - 1].split("")[0]) + 1 }00`

            if(parseInt(result) >= 1000) {
                result = "000"
                arrResult[arrResult.length - 2] = parseInt(arrResult[arrResult.length - 2]) + 1
            }
        } else {
            result = value.split(",")[value.split(",").length - 1]   
        }

        arrResult[arrResult.length - 1] = result
        arrResult = arrResult.join("")

        return arrResult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => canAction ? handleChange() : changeIdProductUpdate(item.id) }>
                <View style={ Tailwind`w-full flex flex-row items-center justify-between py-3 border-b border-gray-200` }>
                    <ImageBackground
                        source={ { uri: `https://adm.wemart.id/public/assets/admin/img/160x160/img2.jpg` } }
                        resizeMode={ "cover" }
                        style={ Tailwind`w-12 h-12 rounded-md overflow-hidden mr-4` }
                    />
                    <View style={ Tailwind`flex flex-col flex-grow` }>
                        <View style={ Tailwind`flex flex-row items-center justify-between` }>
                            <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                { item.name }
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-80` }>
                                Rp{ fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                            </Text>
                        </View>
                        <View style={ Tailwind`flex flex-row items-center justify-between` }>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black` }>
                                { item.sku_id }
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                Stok({ item.stock })
                            </Text>
                        </View>
                    </View>
                </View>
            </TouchableHighlight>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        cart : state.cart,
        transactions: state.transactions
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCart : (value) => dispatch({type: 'CHANGE_CART', newValue: value}),
        changeIdProductUpdate : (value) => dispatch({type: 'CHANGE_IDPRODUCTUPDATE', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ItemListProduct)