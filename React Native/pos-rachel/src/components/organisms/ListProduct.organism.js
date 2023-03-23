import React, { Fragment, useState } from "react"
import { FlatList, Text, View } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import ItemListProduct from "../molecules/ItemListProduct.molecule"

const ListProduct = ({ data, changeRangeProduct, rangeProduct, canAction }) => {
    const handleRefresh = async () => {
        const timeout = setTimeout(() => {
            changeRangeProduct(rangeProduct + 10)
            clearTimeout(timeout)
        }, 500);
    }

    const randomString = () => {
        let text = ""
        const possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890097213897012938214213"

        for (let index = 0; index < 8; index++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length))
        }

        return text
    }

    return (
        <Fragment>
            <View style={ Tailwind`w-full` }>
                <FlatList
                    data={ data }
                    keyExtractor={ (item) => `${ item.sku_id }-${ randomString() }` }
                    showsVerticalScrollIndicator={ false }
                    onEndReached={ () => handleRefresh() }
                    removeClippedSubviews={ true }
                    maxToRenderPerBatch={ 5 }
                    updateCellsBatchingPeriod={ 500 }
                    initialNumToRender={ 10 }
                    windowSize={ 10 }
                    ListFooterComponent={ () => <View style={ Tailwind`h-33` }/> }
                    renderItem={ ({ item, index }) => {
                        return <ItemListProduct item={ item } canAction={ canAction }/>
                    } }
                />
            </View>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        rangeProduct : state.rangeProduct
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeRangeProduct: (value) => dispatch({ type: `CHANGE_RANGEPRODUCT`, newValue: value })
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ListProduct)