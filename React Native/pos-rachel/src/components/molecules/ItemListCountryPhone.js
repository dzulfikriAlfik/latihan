import React, { Fragment } from "react"
import { Pressable, Text, View, Image } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ItemListCountryPhone = ({ item, changeCountryPhone }) => {
    return (
        <Fragment>
            <Pressable onPress={ () => changeCountryPhone(item) }>
                <View style={ Tailwind`w-full flex flex-row items-center h-16 border-b border-gray-200 mb-1` }>
                    <Image
                        source={ item.flag }
                        style={ Tailwind`w-8 h-6 rounded-sm border border-gray-200` }
                        resizeMode={ "contain" }
                    />
                    <View style={ Tailwind`flex flex-col ml-5` }>
                        <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                            { item.name }
                        </Text>
                        <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                            { item.code.display }
                        </Text>
                    </View>
                </View>
            </Pressable>
        </Fragment>
    )
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCountryPhone : (value) => dispatch({type: 'CHANGE_COUNTRYPHONE', newValue: value})
    }
}

export default connect(null, mapDispatchToProps)(ItemListCountryPhone)