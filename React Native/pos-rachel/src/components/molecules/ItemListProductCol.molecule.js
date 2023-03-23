import React, { Fragment } from "react"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { ImageBackground, Text, TouchableHighlight, View } from "react-native"
import { connect } from "react-redux"

const ItemListProductCol = ({ item, cart, changeCart }) => {
    const handleChange = () => {
        const data = [...cart]
        
        if(data.length) {
            let exist = false

            const result = data.map(cartItem => {
                if(cartItem.id === item.id) {
                    exist = true
                    if(cartItem.qty >= item.stock) {
                        return { ...cartItem }
                    } else {
                        return { ...cartItem, qty: cartItem.qty + 1 }
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
    }

    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`mr-5` } onPress={ () => handleChange() }>
                <View style={ Tailwind`w-44 flex flex-col items-center pb-3 bg-white rounded-xl shadow-md` }>
                    <ImageBackground
                        source={ { uri: item.img } }
                        resizeMode={ "cover" }
                        style={ Tailwind`w-full h-44 rounded-xl overflow-hidden` }
                    />
                    <Text style={ Tailwind`font-rubik-medium text-base text-accent--black mt-3` }>
                        { item.name }
                    </Text>
                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-40 mb-1` }>
                        Rp{ item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                    </Text>
                </View>
            </TouchableHighlight>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        cart : state.cart
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCart : (value) => dispatch({type: 'CHANGE_CART', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ItemListProductCol)