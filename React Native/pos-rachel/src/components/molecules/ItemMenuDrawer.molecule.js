import React, { Fragment } from "react"
import { View, Text } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { useRoute } from "@react-navigation/native"

const ItemMenuDrawer = ({ title, icon, path = "" }) => {
    const route = useRoute()

    return (
        <Fragment>
            <View style={ Tailwind`w-full flex flex-row items-center` }>
                <View style={ Tailwind`w-1 h-12 bg-primary--red mr-5 ${ (route.name === path) ? "opacity-100" : "opacity-0" }` }/>
                <View style={ Tailwind`w-11 h-12 flex flex-row items-center` }>
                    { icon }
                </View>
                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs opacity-80 font-medium tracking-wide` }>
                    { title }
                </Text>
            </View>
        </Fragment>
    )
}

export default ItemMenuDrawer