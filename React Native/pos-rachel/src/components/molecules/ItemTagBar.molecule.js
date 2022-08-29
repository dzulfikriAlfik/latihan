import React, { Fragment, useContext } from "react"
import { View, Text, TouchableHighlight } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ItemTagBar = ({ text, context }) => {
    const { tag, setTag } = useContext(context)

    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setTag(text) } style={ Tailwind`rounded-lg` }>
                <View style={ Tailwind`px-8 h-10 rounded-lg ${ tag === text ? "bg-primary--red--20" : "bg-gray-100" } flex flex-col justify-center` }>
                    <Text style={ Tailwind`font-rubik-regular text-sm ${ tag === text ? "text-primary--red" : "text-gray-400" }` }>
                        { text }
                    </Text>
                </View>
            </TouchableHighlight>
        </Fragment>
    )
}

export default ItemTagBar