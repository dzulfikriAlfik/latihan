import React, { Fragment } from "react"
import { Text, View } from "react-native"
import { ArchiveIcon } from "react-native-heroicons/outline"
import LinearGradient from "react-native-linear-gradient"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ItemCarouselFeature = ({ item }) => {
    return (
        <Fragment>
            <View style={ Tailwind`w-96 flex flex-row items-center` }>
                <LinearGradient colors={ ["#AB46D2", "#FF6FB5"] } start={ { x: 0, y: 0 } } style={ Tailwind`w-22 h-22 rounded-3xl flex flex-row items-center justify-center bg-red-200` }>
                    <ArchiveIcon size={ 55 } style={ Tailwind`text-white` }/>
                </LinearGradient>
                <View style={ Tailwind`w-64 flex flex-col ml-5` }>
                    <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                        { item.title }
                    </Text>
                    <Text style={ Tailwind`font-rubik-regular text-accent--black text-sm tracking-wide leading-relaxed opacity-80 mt-1` }>
                        { item.description }
                    </Text>
                    <Text style={ Tailwind`font-rubik-regular text-accent--black font-medium text-xs tracking-wide leading-relaxed mt-1` }>
                        { item.price }
                    </Text>
                </View>
            </View>
        </Fragment>
    )
}

export default ItemCarouselFeature