import React, { Fragment, useState, useEffect } from "react"
import { View, Text, Dimensions } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ItemReport = ({ title, data }) => {
    const [widthScreen, setWidthScreen] = useState(0)

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    useEffect(() => {
        setWidthScreen(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    return (
        <Fragment>
            <View style={ Tailwind`${ handleResponsive(["w-full", "flex-1"]) } h-38 rounded-lg border border-gray-200 flex flex-col p-6 justify-between flex-shrink-0` }>
                <View style={ Tailwind`flex flex-col` }>
                    <Text style={ Tailwind`font-rubik-regular text-accent--black opacity-80 text-sm` }>
                        { title }
                    </Text>
                    <Text style={ Tailwind`font-rubik-medium text-accent--black font-medium text-base` }>
                        { data }
                    </Text>
                </View>
                <View style={ Tailwind`px-3 py-2 rounded-md bg-red-50 self-end` }>
                    <Text style={ Tailwind`font-rubik-regular text-xs text-primary--red` }>
                        Lihat Detail
                    </Text>
                </View>
            </View>
        </Fragment>
    )
}

export default ItemReport