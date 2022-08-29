import React, { Fragment } from "react"
import { TouchableHighlight, Text, View } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"

const ItemListCountry = ({ item, country, changeCountry }) => {
    return (
        <Fragment>
            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => changeCountry(item) }>
                <View style={ Tailwind`w-full flex flex-row items-center h-16 border-b border-gray-200 mb-1` }>
                    <View style={ Tailwind`w-6 h-6 rounded-full ${ country ? item.id === country.id ? "bg-primary--red" : "border-2 border-gray-500" : "border-2 border-gray-500" } flex flex-row items-center justify-center` }>
                        <View style={ Tailwind`w-3 h-3 rounded-full bg-white` }/>
                    </View>
                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 ml-4` }>
                        { item.name }
                    </Text>
                </View>
            </TouchableHighlight>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        country : state.country
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCountry : (value) => dispatch({type: 'CHANGE_COUNTRY', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ItemListCountry)