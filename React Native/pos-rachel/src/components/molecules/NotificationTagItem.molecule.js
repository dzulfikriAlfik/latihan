import React, { Fragment, useContext } from "react"
import { Text, View, TouchableHighlight } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const NotificationTagItem = ({ title, context }) => {
    const { tag, setTag } = useContext(context)

    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => setTag(title) }>
                <View style={ Tailwind`px-4 py-2 rounded-full border ${ title === tag ? "border-orange-500 bg-orange-50" : " border-gray-200 bg-transparent" }` }>
                    <Text style={ Tailwind`text-xs font-rubik-medium ${ title === tag ? "text-orange-500" : "text-accent--black" } opacity-80` }>
                        { title }
                    </Text>
                </View>
            </TouchableHighlight>
        </Fragment>
    )
}

export default NotificationTagItem