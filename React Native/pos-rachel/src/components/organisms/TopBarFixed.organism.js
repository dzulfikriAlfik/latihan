import React, { Fragment } from "react"
import { View } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const TopBarFixed = ({ children }) => {
    return (
        <Fragment>
            <View style={ Tailwind`w-full pt-10 pb-6 px-6 bg-white flex flex-row items-center justify-between shadow-md absolute z-50` }>
                { children }
            </View>
        </Fragment>
    )
}

export default TopBarFixed