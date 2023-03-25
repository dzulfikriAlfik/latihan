import React, { Fragment, useState, useEffect } from "react"
import { TouchableHighlight, View } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { CheckIcon } from "react-native-heroicons/solid"

const Checkbox = ({ onChange }) => {
    const [checked ,setChecked] = useState(false)

    useEffect(() => {
        onChange(checked)
    }, [checked])

    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-sm` } onPress={ () => setChecked((value) => !value) }>
                <View style={ Tailwind`w-5 h-5 flex flex-row items-center justify-center rounded-sm ${ checked ? "bg-primary--red" : "bg-white border border-gray-200" }` }>
                    <CheckIcon size={ 15 } style={ Tailwind`text-white` } />
                </View>
            </TouchableHighlight>
        </Fragment>
    )
}

export default Checkbox