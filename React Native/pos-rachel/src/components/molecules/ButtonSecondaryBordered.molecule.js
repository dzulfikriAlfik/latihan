import React, { Fragment } from "react"
import { Text, View } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ButtonSecondaryBordered = ({ text }) => {
    return (
        <Fragment>
            <View style={ Tailwind`w-full flex flex-row justify-center items-center h-14 rounded-md bg-transparent border border-gray-200` }>
                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                    { text }
                </Text>
            </View>
        </Fragment>
    )
}

export default ButtonSecondaryBordered