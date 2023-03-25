import React, { Fragment } from "react"
import { Text, View } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ButtonPrimaryWhite = ({ text }) => {
    return (
        <Fragment>
            <View style={ Tailwind`w-full flex flex-row justify-center items-center h-14 rounded-md bg-white` }>
                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                    { text }
                </Text>
            </View>
        </Fragment>
    )
}

export default ButtonPrimaryWhite