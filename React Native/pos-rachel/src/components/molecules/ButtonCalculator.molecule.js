import React, { Fragment, useContext } from "react"
import { Text, TouchableHighlight } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ButtonCalculator = ({ number, context }) => {
    const { valueCalculator, setValueCalculator } = useContext(context)
    
    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-full flex-1 bg-transparent border border-gray-200 rounded-lg flex flex-col items-center justify-center` } onPress={ () => setValueCalculator((value) => number === "C" ? "" : value += number) }>
                <Text style={ Tailwind`font-rubik-regular text-base text-accent--black` }>{ number }</Text>
            </TouchableHighlight>
        </Fragment>
    )
}

export default ButtonCalculator