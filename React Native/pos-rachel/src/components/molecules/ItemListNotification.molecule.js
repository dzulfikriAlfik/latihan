import React, { Fragment } from "react"
import { Text, View } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ItemListNotification = ({ item }) => {
    return (
        <Fragment>
            <View style={ Tailwind`w-full p-5 flex flex-col bg-orange-50 border-b border-gray-200` }>
                <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                    { item.title }
                </Text>
                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs opacity-60 mt-1` }>
                    { item.description }
                </Text>
                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs opacity-30 mt-1` }>
                    { item.date }
                </Text>
            </View>
        </Fragment>
    )
}

export default ItemListNotification