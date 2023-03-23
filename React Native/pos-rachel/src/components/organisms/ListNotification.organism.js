import React, { Fragment } from "react"
import { FlatList, View } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import ItemListNotification from "../molecules/ItemListNotification.molecule"

const ListNotification = ({ data }) => {
    return (
        <Fragment>
            <FlatList
                data={ data }
                ListHeaderComponent={ () => <View style={ Tailwind`mt-6` }/> }
                keyExtractor={ (item, index) => index }
                renderItem={ ({ item }) => {
                    return <ItemListNotification item={ item }/>
                } }
            />
        </Fragment>
    )
}

export default ListNotification