import React, { createContext, Fragment, useState } from "react"
import { Text, View, TouchableHighlight } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import ButtonCalculator from "../molecules/ButtonCalculator.molecule"
import { BackspaceIcon } from "react-native-heroicons/solid"
import { ShoppingCartIcon } from "react-native-heroicons/outline"

const CalculatorContext = createContext()
const { Provider } = CalculatorContext

const ManualView = ({ widthComponent, cart, changeCart }) => {
    const [valueCalculator, setValueCalculator] = useState("")

    const addCart = () => {
        changeCart([...cart, { name: "Manual Cart", price: parseInt(valueCalculator), qty: 1 }])

        setValueCalculator("")
    }

    return (
        <Fragment>
            <Provider value={ { valueCalculator, setValueCalculator } }>
                <View style={ [Tailwind`h-full flex flex-col justify-between`, { width: widthComponent }] }>
                    <View style={ Tailwind`h-40 bg-gray-100 rounded-lg flex flex-row items-center justify-end p-5` }>
                        <Text style={ Tailwind`font-rubik-semibold text-xl text-accent--black` }>
                            Rp{ valueCalculator ? parseInt(valueCalculator).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : "0" }
                        </Text>
                    </View>
                    <View style={ Tailwind`flex-grow w-full flex flex-row justify-between mt-5` }>
                        <View style={ Tailwind`flex-1 flex flex-col` }>
                            <ButtonCalculator number={ "1" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "4" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "7" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "0" } context={ CalculatorContext }/>
                        </View>
                        <View style={ Tailwind`w-3` }/>
                        <View style={ Tailwind`flex-1` }>
                            <ButtonCalculator number={ "2" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "5" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "8" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "000" } context={ CalculatorContext }/>
                        </View>
                        <View style={ Tailwind`w-3` }/>
                        <View style={ Tailwind`flex-1` }>
                            <ButtonCalculator number={ "3" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "6" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "9" } context={ CalculatorContext }/>
                            <View style={ Tailwind`h-3` }/>
                            <ButtonCalculator number={ "C" } context={ CalculatorContext }/>
                        </View>
                        <View style={ Tailwind`w-3` }/>
                        <View style={ Tailwind`flex-1` }>
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setValueCalculator((value) => (valueCalculator) ? value.slice(0, -1) : "") } style={ Tailwind`w-full flex-1 bg-primary--red--20 rounded-lg flex flex-col items-center justify-center` }>
                                <BackspaceIcon size={ 40 } style={ Tailwind`text-primary--red opacity-70` }/>
                            </TouchableHighlight>
                            <View style={ Tailwind`h-3` }/>
                            <TouchableHighlight onPress={ () => addCart() } underlayColor={ "#10101010" } style={ Tailwind`w-full flex-1 bg-primary--red--20 rounded-lg flex flex-col items-center justify-center` }>
                                <ShoppingCartIcon size={ 40 } style={ Tailwind`text-primary--red opacity-70` }/>
                            </TouchableHighlight>
                        </View>
                    </View>
                </View>
            </Provider>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        widthComponent : state.widthComponent,
        cart: state.cart
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCart : (value) => dispatch({type: 'CHANGE_CART', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ManualView)